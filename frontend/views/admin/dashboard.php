<?php
$pageTitle = "Dashboard Admin";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2rem; color: var(--text-main); margin-bottom: 0.5rem;">Tableau de bord administrateur</h1>
    <p style="color: var(--text-muted);">Vue d'ensemble de l'activité du site.</p>
</div>

<!-- Grille de KPIs -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    
    <div style="background: white; padding: 2rem; border-radius: var(--radius); border-left: 6px solid var(--primary); box-shadow: var(--shadow-sm);">
        <span style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">TOTAL ANNONCES</span>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 1rem;">
            <h2 style="font-size: 2.5rem; margin: 0;"><?= (int)$stats['total'] ?></h2>
            <i class="fas fa-bullhorn" style="font-size: 2rem; color: #f1f5f9;"></i>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: var(--radius); border-left: 6px solid var(--danger); box-shadow: var(--shadow-sm);">
        <span style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">OBJETS PERDUS</span>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 1rem;">
            <h2 style="font-size: 2.5rem; margin: 0;"><?= (int)$stats['lost'] ?></h2>
            <i class="fas fa-search" style="font-size: 2rem; color: #f1f5f9;"></i>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: var(--radius); border-left: 6px solid var(--accent); box-shadow: var(--shadow-sm);">
        <span style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">OBJETS TROUVÉS</span>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 1rem;">
            <h2 style="font-size: 2.5rem; margin: 0;"><?= (int)$stats['found'] ?></h2>
            <i class="fas fa-hand-holding-heart" style="font-size: 2rem; color: #f1f5f9;"></i>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: var(--radius); border-left: 6px solid var(--success); box-shadow: var(--shadow-sm);">
        <span style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">RÉSOLUTIONS</span>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 1rem;">
            <h2 style="font-size: 2.5rem; margin: 0;"><?= (int)$stats['resolved'] ?></h2>
            <i class="fas fa-check-circle" style="font-size: 2rem; color: #f1f5f9;"></i>
        </div>
    </div>

</div>

<!-- Liens rapides de gestion -->
<div style="display: flex; gap: 1rem;">
    <a href="<?= BASE_URL ?>/index.php?action=admin.users" class="btn btn-primary">
        <i class="fas fa-users-cog"></i> Gérer les utilisateurs
    </a>
    <a href="<?= BASE_URL ?>/index.php?action=admin.ads" class="btn btn-outline">
        <i class="fas fa-tasks"></i> Modérer les annonces
    </a>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
