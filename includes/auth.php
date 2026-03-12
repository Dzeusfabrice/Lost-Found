<?php

/**
 * includes/auth.php — Fonctions d'authentification globales
 * Responsable : P4 — Développeur Logique 1
 * LOC cible : < 60
 */

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isAdmin(): bool
{
    return isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        redirect('login');
        exit;
    }
}

function requireAdmin(): void
{
    requireLogin();
    if (!isAdmin()) {
        http_response_code(403);
        require VIEWS_PATH . '/errors/403.php';
        exit;
    }
}

function currentUserId(): ?int
{
    return isLoggedIn() ? (int) $_SESSION['user_id'] : null;
}

function redirect(string $action, array $params = []): void
{
    $url = BASE_URL . '/index.php?action=' . urlencode($action);
    foreach ($params as $key => $value) {
        $url .= '&' . urlencode($key) . '=' . urlencode($value);
    }
    header('Location: ' . $url);
    exit;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
