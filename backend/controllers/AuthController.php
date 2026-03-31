<?php

/**
 * AuthController — Login, register, logout, session
 * Responsable : P4 — Développeur Logique 1
 */
class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = ModelFactory::create('user');
    }

    public function welcome(): void
    {
        require VIEWS_PATH . '/welcome.php';
    }

    public function home(): void
    {
        require VIEWS_PATH . '/home.php';
    }

    public function login(): void
    {
        if (isLoggedIn()) redirect('profile');

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

            if ($user && $this->userModel->verifyPassword($password, $user['password_hash'])) {
                if ($user['is_active'] == 0) {
                    $error = "Votre compte est suspendu.";
                } else {
                    // Succès : Régénération de session contre la fixation
                    session_regenerate_id(true);
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_name'] = $user['name'];
                    redirect('profile');
                }
            } else {
                $error = "Identifiants invalides.";
            }
        }

        require VIEWS_PATH . '/auth/login.php';
    }

    public function register(): void
    {
        if (isLoggedIn()) redirect('profile');

        $errors = [];
        $old    = $_POST;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            checkCsrf();

            // Validation sommaire (pourra être étendue)
            if (empty($_POST['name'])) $errors['name'] = "Nom requis.";
            if (empty($_POST['email'])) $errors['email'] = "Email requis.";
            if (strlen($_POST['password'] ?? '') < 8) $errors['password'] = "8 caractères minimum.";

            if (empty($errors)) {
                try {
                    $this->userModel->create($_POST);
                    redirect('login', ['registered' => 1]);
                } catch (Exception $e) {
                    $errors['email'] = "Cet email est déjà utilisé.";
                }
            }
        }

        require VIEWS_PATH . '/auth/register.php';
    }

    public function profile(): void
    {
        requireLogin();
        $user = $this->userModel->findById(currentUserId());
        $adModel = ModelFactory::create('ad');
        $ads = $adModel->findByUser(currentUserId());

        require VIEWS_PATH . '/profile/index.php';
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        redirect('login');
    }
}
