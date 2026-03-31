<?php
/**
 * header.php — En-tête HTML commun
 * Responsable : P3 — HILARY
 */

// On s'assure que les variables globales sont disponibles
$isLoggedIn = isLoggedIn();
$currentUser = $_SESSION['user_name'] ?? null;
$unreadCount = 0;

if ($isLoggedIn) {
    $messageModel = ModelFactory::create('message');
    $unreadCount = $messageModel->getUnreadCount($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' : '' ?>Lost & Found</title>
    
    <!-- SEO -->
    <meta name="description" content="Application de gestion d'objets perdus et trouvés. Publiez des annonces et retrouvez vos affaires.">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/public/css/style.css">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="navbar">
    <div class="container navbar-container">
        <a href="<?= BASE_URL ?>/index.php" class="logo">
            <i class="fas fa-search-location"></i>
            Lost<span style="color: var(--primary);">Found</span>
        </a>

        <nav>
            <div class="menu-toggle" id="mobile-menu-btn" style="display: none; cursor: pointer; font-size: 1.5rem; color: var(--text-main);">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="navbar-links">
                <li><a href="<?= BASE_URL ?>/index.php?action=ads" class="nav-link <?= ($_GET['action'] ?? 'home') === 'ads' ? 'active' : '' ?>">Explorer</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?action=search" class="nav-link <?= ($_GET['action'] ?? '') === 'search' ? 'active' : '' ?>">Rechercher</a></li>
                
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item-relative">
                        <a href="<?= BASE_URL ?>/index.php?action=messages" class="nav-link <?= ($_GET['action'] ?? '') === 'messages' ? 'active' : '' ?>">
                            Conversations
                            <?php if ($unreadCount > 0): ?>
                                <span class="badge"><?= $unreadCount ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li><a href="<?= BASE_URL ?>/index.php?action=profile" class="nav-link <?= ($_GET['action'] ?? '') === 'profile' ? 'active' : '' ?>"><i class="fas fa-user-circle"></i> <?= e($currentUser) ?></a></li>
                    
                    <?php if (isAdmin()): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?action=admin" class="btn btn-outline" style="padding: 0.5rem 1rem; border-radius: 99px; font-size: 0.8rem;"><i class="fas fa-shield-halved"></i> Admin</a></li>
                    <?php endif; ?>
                    
                    <li><a href="<?= BASE_URL ?>/index.php?action=logout" class="nav-link" title="Déconnexion"><i class="fas fa-power-off"></i></a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/index.php?action=login" class="nav-link">Connexion</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?action=register" class="btn btn-primary" style="padding: 0.75rem 1.5rem; border-radius: 99px;">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <style>
            @media (max-width: 768px) {
                .menu-toggle { display: block !important; }
                .nav-links {
                    position: fixed;
                    top: 80px;
                    left: -100%;
                    width: 100%;
                    height: calc(100vh - 80px);
                    background: white;
                    flex-direction: column;
                    padding: 2rem;
                    gap: 1.5rem;
                    transition: 0.3s ease-in-out;
                    z-index: 999;
                    display: flex !important;
                }
                .nav-links.active { left: 0; }
                .nav-link { padding: 1rem 0; font-size: 1.25rem; width: 100%; text-align: left; }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const btn = document.getElementById('mobile-menu-btn');
                const menu = document.getElementById('navbar-links');
                if (btn) {
                    btn.addEventListener('click', () => {
                        menu.classList.toggle('active');
                        const icon = btn.querySelector('i');
                        icon.classList.toggle('fa-bars');
                        icon.classList.toggle('fa-times');
                    });
                }
            });
        </script>
    </div>
</header>

<main class="container" style="min-height: calc(100vh - 280px); padding: 3rem 1.5rem;">
