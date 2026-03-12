<?php

/**
 * Bootstrap — Chargement de la configuration globale, autoload, constantes
 * Responsable : P6 — Noumi
 * LOC cible : < 50
 */

// --- Constantes globales ---
define('ROOT_PATH',    dirname(__DIR__));
define('VIEWS_PATH',   ROOT_PATH . '/views');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');
define('UPLOADS_URL',  '/lostfound/uploads');
define('APP_NAME',     'Lost & Found');
define('BASE_URL',     '/lostfound');

// --- Configuration d'affichage ---
error_reporting(E_ALL);
ini_set('display_errors', '1'); // Passer à 0 en production

// --- Chargement de la configuration BDD ---
require_once ROOT_PATH . '/config/database.php';

// --- Autoloader PSR-4 simplifié ---
spl_autoload_register(function (string $class): void {
    $map = [
        'Database'             => ROOT_PATH . '/core/Database.php',
        'ModelFactory'         => ROOT_PATH . '/core/ModelFactory.php',
        'Router'               => ROOT_PATH . '/core/Router.php',
        'FilterStrategy'       => ROOT_PATH . '/core/FilterStrategy.php',
        'TypeFilter'           => ROOT_PATH . '/core/filters/TypeFilter.php',
        'CityFilter'           => ROOT_PATH . '/core/filters/CityFilter.php',
        'DateFilter'           => ROOT_PATH . '/core/filters/DateFilter.php',
        'KeywordFilter'        => ROOT_PATH . '/core/filters/KeywordFilter.php',
        'UserModel'            => ROOT_PATH . '/models/UserModel.php',
        'AdModel'              => ROOT_PATH . '/models/AdModel.php',
        'ConversationModel'    => ROOT_PATH . '/models/ConversationModel.php',
        'MessageModel'         => ROOT_PATH . '/models/MessageModel.php',
        'AuthController'       => ROOT_PATH . '/controllers/AuthController.php',
        'AdController'         => ROOT_PATH . '/controllers/AdController.php',
        'SearchController'     => ROOT_PATH . '/controllers/SearchController.php',
        'MessageController'    => ROOT_PATH . '/controllers/MessageController.php',
        'AdminController'      => ROOT_PATH . '/controllers/AdminController.php',
        'UploadService'        => ROOT_PATH . '/services/UploadService.php',
    ];

    if (isset($map[$class])) {
        require_once $map[$class];
    }
});

// --- Helpers globaux ---
require_once ROOT_PATH . '/includes/auth.php';
require_once ROOT_PATH . '/includes/csrf.php';

// --- Démarrage de session sécurisée ---
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => false, // Passer à true en HTTPS
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}
