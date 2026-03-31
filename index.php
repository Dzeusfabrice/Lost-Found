<?php

/**
 * index.php — Front Controller (Point d'entrée unique)
 * Responsable : P4 — Développeur Logique 1
 */

// Chargement du système (config, autoload, session, helpers)
require_once __DIR__ . '/backend/config/bootstrap.php';

// Récupération de l'action depuis l'URL (ex: index.php?action=login)
$action = $_GET['action'] ?? 'welcome';

// Initialisation du routeur et dispatching
$router = new Router();

try {
    $router->dispatch($action);
} catch (Exception $e) {
    // En développement, on affiche l'erreur. En prod, on logguerait.
    error_log($e->getMessage());
    echo "Une erreur critique est survenue. Veuillez contacter l'administrateur.";
}
