<?php

/**
 * AdminController — Dashboard, modération
 * Responsable : P6 — Développeur Logique 3
 */
class AdminController
{
    private UserModel $userModel;
    private AdModel $adModel;

    public function __construct()
    {
        requireAdmin();
        $this->userModel = ModelFactory::create('user');
        $this->adModel   = ModelFactory::create('ad');
    }

    public function dashboard(): void
    {
        $stats = $this->adModel->getStats();
        require VIEWS_PATH . '/admin/dashboard.php';
    }

    public function users(): void
    {
        $users = $this->userModel->findAll();
        require VIEWS_PATH . '/admin/users.php';
    }

    public function ads(): void
    {
        $ads = $this->adModel->findAll(true);
        require VIEWS_PATH . '/admin/ads.php';
    }

    public function suspendUser(): void
    {
        checkCsrf();
        $id     = (int)($_POST['id'] ?? 0);
        $active = (bool)($_POST['active'] ?? 0);
        $this->userModel->setActive($id, $active);
        redirect('admin.users');
    }

    public function deleteUser(): void
    {
        checkCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $this->userModel->delete($id);
        redirect('admin.users');
    }
}
