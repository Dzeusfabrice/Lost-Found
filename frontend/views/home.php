<?php
$pageTitle = "Bienvenue";
require VIEWS_PATH . '/layouts/header.php';
?>

<!-- Hero Section -->
<section style="padding: 5rem 0; text-align: center; background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%); border-radius: var(--radius); margin-bottom: 4rem; border: 1px solid #e2e8f0;">
    <div style="max-width: 800px; margin: 0 auto;">
        <span style="background: #e0e7ff; color: var(--primary); padding: 5px 15px; border-radius: 99px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
            Service Communautaire Gratuit
        </span>
        <h1 style="font-size: 3.5rem; color: var(--text-main); line-height: 1.2; margin: 1.5rem 0;">
            Retrouvez ce que vous avez <span style="color: var(--primary);">égaré</span>.
        </h1>
        <p style="font-size: 1.25rem; color: var(--text-muted); margin-bottom: 2.5rem;">
            Lost & Found aide les citoyens à signaler des objets perdus ou trouvés en quelques clics. Simple, rapide et sécurisé.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="<?= BASE_URL ?>/index.php?action=ads" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1rem;">
                <i class="fas fa-search"></i> Parcourir les annonces
            </a>
            <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-outline" style="padding: 1rem 2rem; font-size: 1rem;">
                <i class="fas fa-plus"></i> Publier une annonce
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
    <div style="background: white; padding: 2.5rem; border-radius: var(--radius); border: 1px solid #f1f5f9; transition: var(--transition); box-shadow: var(--shadow-sm);">
        <div style="width: 50px; height: 50px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem;">
            <i class="fas fa-search"></i>
        </div>
        <h3 style="margin-bottom: 1rem;">Signaler une perte</h3>
        <p style="color: var(--text-muted);">Décrivez votre objet, ajoutez une photo et précisez le lieu pour que la communauté puisse vous aider.</p>
    </div>

    <div style="background: white; padding: 2.5rem; border-radius: var(--radius); border: 1px solid #f1f5f9; transition: var(--transition); box-shadow: var(--shadow-sm);">
        <div style="width: 50px; height: 50px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem;">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h3 style="margin-bottom: 1rem;">Rendre un objet</h3>
        <p style="color: var(--text-muted);">Vous avez trouvé quelque chose ? Publiez une annonce "Trouvé" et entrez en contact avec le propriétaire.</p>
    </div>

    <div style="background: white; padding: 2.5rem; border-radius: var(--radius); border: 1px solid #f1f5f9; transition: var(--transition); box-shadow: var(--shadow-sm);">
        <div style="width: 50px; height: 50px; background: #dcfce7; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem;">
            <i class="fas fa-comments"></i>
        </div>
        <h3 style="margin-bottom: 1rem;">Messagerie Interne</h3>
        <p style="color: var(--text-muted);">Discutez en toute sécurité via notre chat intégré pour organiser la remise de l'objet en main propre.</p>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
