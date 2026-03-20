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
            <ul class="nav-links">
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
                    <li><a href="<?= BASE_URL ?>/index.php?action=register" class="btn btn-primary">Créer un compte</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="container" style="min-height: calc(100vh - 280px); padding: 3rem 1.5rem;">
