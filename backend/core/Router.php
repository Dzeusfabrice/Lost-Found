<?php

/**
 * Router — Front Controller dispatcher
 * Achemine les requêtes vers le bon contrôleur selon l'action GET.
 * Responsable : P4 (déclenché depuis index.php)
 */
class Router
{
    /** @var array<string, array{controller: string, method: string, auth: bool, admin: bool}> */
    private array $routes = [
        // Auth
        'home'              => ['controller' => 'AuthController',    'method' => 'home',           'auth' => false, 'admin' => false],
        'login'             => ['controller' => 'AuthController',    'method' => 'login',          'auth' => false, 'admin' => false],
        'register'          => ['controller' => 'AuthController',    'method' => 'register',       'auth' => false, 'admin' => false],
        'logout'            => ['controller' => 'AuthController',    'method' => 'logout',         'auth' => true,  'admin' => false],
        'profile'           => ['controller' => 'AuthController',    'method' => 'profile',        'auth' => true,  'admin' => false],
        'profile.edit'      => ['controller' => 'AuthController',    'method' => 'editProfile',    'auth' => true,  'admin' => false],
        'forgot'            => ['controller' => 'AuthController',    'method' => 'forgot',         'auth' => false, 'admin' => false],

        // Annonces
        'ads'               => ['controller' => 'AdController',      'method' => 'index',          'auth' => false, 'admin' => false],
        'ads.view'          => ['controller' => 'AdController',      'method' => 'view',           'auth' => false, 'admin' => false],
        'ads.create'        => ['controller' => 'AdController',      'method' => 'create',         'auth' => true,  'admin' => false],
        'ads.edit'          => ['controller' => 'AdController',      'method' => 'edit',           'auth' => true,  'admin' => false],
        'ads.delete'        => ['controller' => 'AdController',      'method' => 'delete',         'auth' => true,  'admin' => false],
        'ads.status'        => ['controller' => 'AdController',      'method' => 'changeStatus',   'auth' => true,  'admin' => false],
        'ads.mine'          => ['controller' => 'AdController',      'method' => 'myAds',          'auth' => true,  'admin' => false],

        // Recherche
        'search'            => ['controller' => 'SearchController',  'method' => 'handle',         'auth' => false, 'admin' => false],

        // Messagerie
        'messages'          => ['controller' => 'MessageController', 'method' => 'index',          'auth' => true,  'admin' => false],
        'messages.view'     => ['controller' => 'MessageController', 'method' => 'view',           'auth' => true,  'admin' => false],
        'messages.send'     => ['controller' => 'MessageController', 'method' => 'send',           'auth' => true,  'admin' => false],
        'messages.start'    => ['controller' => 'MessageController', 'method' => 'start',          'auth' => true,  'admin' => false],

        // Admin
        'admin'             => ['controller' => 'AdminController',   'method' => 'dashboard',      'auth' => true,  'admin' => true],
        'admin.users'       => ['controller' => 'AdminController',   'method' => 'users',          'auth' => true,  'admin' => true],
        'admin.ads'         => ['controller' => 'AdminController',   'method' => 'ads',            'auth' => true,  'admin' => true],
        'admin.suspend'     => ['controller' => 'AdminController',   'method' => 'suspendUser',    'auth' => true,  'admin' => true],
        'admin.delete.user' => ['controller' => 'AdminController',   'method' => 'deleteUser',     'auth' => true,  'admin' => true],
        'admin.hide.ad'     => ['controller' => 'AdminController',   'method' => 'hideAd',         'auth' => true,  'admin' => true],
        'admin.delete.ad'   => ['controller' => 'AdminController',   'method' => 'deleteAd',       'auth' => true,  'admin' => true],
    ];

    public function dispatch(string $action): void
    {
        $route = $this->routes[$action] ?? null;

        if ($route === null) {
            $this->render404();
            return;
        }

        // Protection d'accès
        if ($route['auth'] && !isLoggedIn()) {
            redirect('login');
            return;
        }
        if ($route['admin'] && !isAdmin()) {
            $this->render403();
            return;
        }

        $controllerClass = $route['controller'];
        $method          = $route['method'];

        if (!class_exists($controllerClass)) {
            $this->render404();
            return;
        }

        $controller = new $controllerClass();
        $controller->$method();
    }

    private function render404(): void
    {
        http_response_code(404);
        require VIEWS_PATH . '/errors/404.php';
    }

    private function render403(): void
    {
        http_response_code(403);
        require VIEWS_PATH . '/errors/403.php';
    }
}
