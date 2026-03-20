<?php

/**
 * AdController — CRUD annonces, upload photo
 * Responsable : P5 — Développeur Logique 2
 */
class AdController
{
    private AdModel $adModel;
    private UploadService $uploadService;

    public function __construct()
    {
        $this->adModel       = ModelFactory::create('ad');
        $this->uploadService = new UploadService();
    }

    public function index(): void
    {
        // Liste par défaut (sans filtres complexes, via SearchController pour les filtres)
        $result = $this->adModel->search([], [], (int)($_GET['page'] ?? 1));
        $ads        = $result['ads'];
        $pagination = $result;

        require VIEWS_PATH . '/ads/list.php';
    }

    public function view(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $ad = $this->adModel->findById($id);

        if (!$ad) {
            redirect('ads');
        }

        $canContact = isLoggedIn() && (currentUserId() !== (int)$ad['user_id']);

        require VIEWS_PATH . '/ads/view.php';
    }

    public function create(): void
    {
        requireLogin();
        $errors = [];
        $old    = $_POST;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            checkCsrf();

            // Validation simple
            if (empty($_POST['title'])) $errors[] = "Le titre est requis.";

            // Traitement image
            $photoPath = null;
            if (!empty($_FILES['photo']['name'])) {
                $photoPath = $this->uploadService->store($_FILES['photo']);
                if (!$photoPath) $errors[] = "Erreur lors de l'upload de l'image (MIME, taille ou format invalide).";
            }

            if (empty($errors)) {
                $data = $_POST;
                $data['user_id']    = currentUserId();
                $data['photo_path'] = $photoPath;
                $this->adModel->create($data);
                redirect('profile');
            }
        }

        require VIEWS_PATH . '/ads/create.php';
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $ad = $this->adModel->findById($id);

        if (!$ad || (int)$ad['user_id'] !== currentUserId()) {
            redirect('profile');
        }

        $errors = [];
        $old    = $ad;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            checkCsrf();
            if (empty($_POST['title'])) $errors[] = "Le titre est requis.";

            $photoPath = $ad['photo_path'];
            if (!empty($_FILES['photo']['name'])) {
                $newPhoto = $this->uploadService->store($_FILES['photo']);
                if ($newPhoto) $photoPath = $newPhoto;
                else $errors[] = "Erreur lors de l'upload de l'image.";
            }

            if (empty($errors)) {
                $data = $_POST;
                $data['photo_path'] = $photoPath;
                $this->adModel->update($id, $data);
                redirect('ads.view', ['id' => $id]);
            }
            $old = $_POST;
        }

        require VIEWS_PATH . '/ads/edit.php';
    }

    public function changeStatus(): void
    {
        requireLogin();
        checkCsrf();

        $id = (int)($_POST['id'] ?? 0);
        if ($this->adModel->changeStatus($id, currentUserId())) {
            redirect('ads.view', ['id' => $id]);
        } else {
            redirect('profile');
        }
    }
}
