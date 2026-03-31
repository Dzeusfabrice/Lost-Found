<?php
$pageTitle = "Accueil";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="hero-section" style="padding: 6rem 0; text-align: center; position: relative; overflow: hidden;">
    <!-- Abstract background shape -->
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: var(--primary-soft); filter: blur(100px); border-radius: 50%; z-index: -1;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: rgba(168, 85, 247, 0.1); filter: blur(80px); border-radius: 50%; z-index: -1;"></div>

    <div style="max-width: 1100px; margin: 0 auto;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: white; padding: 6px 16px; border-radius: 99px; box-shadow: var(--shadow-sm); border: 1px solid #f1f5f9; margin-bottom: 2rem;">
            <span style="width: 8px; height: 8px; background: var(--success); border-radius: 50%; display: inline-block;"></span>
            <span style="font-weight: 700; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em;">Service Citoyen & Gratuit</span>
        </div>
        
        <h1 class="h1-res" style="font-size: 4.5rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 2rem;">
            Retrouvez ce qui vous <br> <span class="text-gradient">appartient.</span>
        </h1>
        
        <p style="font-size: 1.35rem; color: var(--text-muted); margin-bottom: 3rem; line-height: 1.6; max-width: 700px; margin-left: auto; margin-right: auto;">
            Connectez les objets perdus à leurs propriétaires en un clic. Une plateforme moderne, simple et solidaire pour toute la communauté.
        </p>
        
        <div class="res-flex" style="display: flex; gap: 1.5rem; justify-content: center;">
            <a href="<?= BASE_URL ?>/index.php?action=search" class="btn btn-primary" style="padding: 1.25rem 2.5rem; font-size: 1.1rem; border-radius: var(--radius-lg); width: auto;">
                <i class="fas fa-search"></i> Explorer les annonces
            </a>
            <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-outline" style="padding: 1.25rem 2.5rem; font-size: 1.1rem; border-radius: var(--radius-lg); width: auto;">
                <i class="fas fa-plus-circle"></i> Publier un signalement
            </a>
        </div>
    </div>
</div>

<div class="features-grid res-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; margin: 4rem 0;">
    <div class="card" style="border: none; background: white; padding: 3rem; text-align: center;">
        <div style="width: 64px; height: 64px; background: #fee2e2; color: #ef4444; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 1.5rem; box-shadow: 0 10px 15px -5px rgba(239, 68, 68, 0.2);">
            <i class="fas fa-bullhorn"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; font-weight: 700;">Signaler une perte</h3>
        <p style="color: var(--text-muted); font-size: 1.05rem;">Décrivez précisément votre objet et laissez la communauté vous aider à le retrouver rapidement.</p>
    </div>

    <div class="card" style="border: none; background: white; padding: 3rem; text-align: center;">
        <div style="width: 64px; height: 64px; background: #fef3c7; color: #f59e0b; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 1.5rem; box-shadow: 0 10px 15px -5px rgba(245, 158, 11, 0.2);">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; font-weight: 700;">Rendre service</h3>
        <p style="color: var(--text-muted); font-size: 1.05rem;">Vous avez trouvé quelque chose ? Publiez une annonce et devenez le héros d'un propriétaire inquiet.</p>
    </div>

    <div class="card" style="border: none; background: white; padding: 3rem; text-align: center;">
        <div style="width: 64px; height: 64px; background: #e0e7ff; color: var(--primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 1.5rem; box-shadow: 0 10px 15px -5px rgba(79, 70, 229, 0.2);">
            <i class="fas fa-shield-check"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; font-weight: 700;">Chat Sécurisé</h3>
        <p style="color: var(--text-muted); font-size: 1.05rem;">Échangez directement via notre messagerie interne pour organiser la restitution en toute confiance.</p>
    </div>
</div>

<div class="res-padding" style="background: linear-gradient(135deg, var(--text-main), #1e293b); border-radius: var(--radius-lg); padding: 5rem; text-align: center; color: white; margin-bottom: 4rem; box-shadow: var(--shadow-xl); position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; background: var(--primary); opacity: 0.1; filter: blur(50px); border-radius: 50%;"></div>
    <div style="max-width: 900px; margin: 0 auto; position: relative; z-index: 1;">
        <h2 style="font-size: 3rem; margin-bottom: 1.5rem; font-weight: 800; letter-spacing: -1px;">Prêt à retrouver vos affaires ?</h2>
        <p style="font-size: 1.2rem; color: #94a3b8; margin-bottom: 3rem; line-height: 1.6;">Rejoignez des milliers d'utilisateurs qui font confiance à LostFound chaque jour pour solidarité locale.</p>
        <a href="<?= BASE_URL ?>/index.php?action=register" class="btn btn-primary" style="background: white; color: var(--text-main); padding: 1rem 2.5rem; font-size: 1.1rem; box-shadow: none;">Créer un compte maintenant</a>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
