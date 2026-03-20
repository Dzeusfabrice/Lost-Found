<?php
/**
 * views/auth/login.php — Login Startup Style
 */
$pageTitle = "Déverrouiller l'accès";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="max-width: 500px; margin: 4rem auto; position: relative;">
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; background: var(--primary-soft); filter: blur(80px); border-radius: 50%; z-index: -1;"></div>
    
    <div class="card" style="padding: 4rem 3rem; border: none; background: white; border-radius: 3rem; box-shadow: var(--shadow-xl); text-align: center;">
        <div style="width: 72px; height: 72px; background: var(--primary-soft); color: var(--primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2.5rem; font-size: 1.8rem; box-shadow: var(--shadow-md);">
            <i class="fas fa-lock-open"></i>
        </div>
        
        <h1 style="font-size: 2.25rem; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 0.75rem; color: var(--text-main);">Identifiez-vous.</h1>
        <p class="text-muted" style="font-size: 1.1rem; margin-bottom: 3rem; font-weight: 500;">Entrez vos identifiants pour accéder à votre espace sécurisé.</p>

        <?php if (isset($_GET['registered'])): ?>
            <div style="background: #d1fae5; color: #10b981; padding: 1rem; border-radius: 1.25rem; margin-bottom: 2rem; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; justify-content: center;">
                <i class="fas fa-check-circle"></i> Votre compte est prêt !
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div style="background: #fee2e2; color: #ef4444; padding: 1rem; border-radius: 1.25rem; margin-bottom: 2rem; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; justify-content: center;">
                <i class="fas fa-exclamation-triangle"></i> <?= e($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/index.php?action=login" method="POST" style="text-align: left;">
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Adresse email</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" required autofocus style="padding-left: 3rem; border-radius: 1.25rem; height: 56px;">
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 2.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.6rem;">
                    <label class="form-label" style="margin-bottom: 0;">Mot de passe</label>
                    <a href="#" style="font-size: 0.8rem; color: var(--primary); text-decoration: none; font-weight: 700;">Secret oublié ?</a>
                </div>
                <div style="position: relative;">
                    <i class="fas fa-shield-keyhole" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required style="padding-left: 3rem; border-radius: 1.25rem; height: 56px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 60px; border-radius: 1.5rem; font-size: 1.1rem; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);">
                Se connecter
            </button>
        </form>

        <div style="text-align: center; margin-top: 3rem; color: var(--text-muted); font-size: 1.05rem; font-weight: 500;">
            Pas encore de compte ? 
            <a href="<?= BASE_URL ?>/index.php?action=register" style="color: var(--primary); font-weight: 800; text-decoration: none;">S'inscrire gratuitement</a>
        </div>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
