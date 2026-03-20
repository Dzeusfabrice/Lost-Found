<?php
/**
 * views/auth/register.php — Inscription Startup Style
 */
$pageTitle = "Créer mon compte";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="max-width: 550px; margin: 3rem auto; position: relative;">
    <div style="position: absolute; bottom: -50px; right: -50px; width: 250px; height: 250px; background: rgba(168, 85, 247, 0.1); filter: blur(90px); border-radius: 50%; z-index: -1;"></div>
    
    <div class="card" style="padding: 4rem 3.5rem; border: none; background: white; border-radius: 3.5rem; box-shadow: var(--shadow-xl); text-align: center;">
        <div style="width: 72px; height: 72px; background: var(--primary-soft); color: var(--primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2.5rem; font-size: 1.8rem; box-shadow: var(--shadow-md);">
            <i class="fas fa-user-plus"></i>
        </div>
        
        <h1 style="font-size: 2.25rem; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 0.75rem; color: var(--text-main);">Rejoignez-nous.</h1>
        <p class="text-muted" style="font-size: 1.1rem; margin-bottom: 3rem; font-weight: 500;">Créez votre compte LostFound pour signaler et retrouver des objets.</p>

        <?php if (!empty($errors)): ?>
            <div style="background: #fee2e2; color: #ef4444; padding: 1.25rem; border-radius: 1.5rem; margin-bottom: 2rem; font-weight: 700; font-size: 0.9rem; text-align: left; display: flex; align-items: center; gap: 12px; border: 1px solid rgba(239, 68, 68, 0.2);">
                <i class="fas fa-exclamation-circle" style="font-size: 1.25rem;"></i> Correction requise.
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/index.php?action=register" method="POST" style="text-align: left;">
            <input type="hidden" name="csrf_token" value="<?= getCsrfToken() ?>">
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Nom complet</label>
                <div style="position: relative;">
                    <i class="fas fa-user-circle" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="text" name="name" class="form-control" placeholder="Jean Dupont" value="<?= e($old['name'] ?? '') ?>" required autofocus style="padding-left: 3rem; border-radius: 1.25rem; height: 56px;">
                </div>
                <?php if (isset($errors['name'])): ?>
                    <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 6px; padding-left: 1rem;"><?= e($errors['name']) ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Adresse email</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" value="<?= e($old['email'] ?? '') ?>" required style="padding-left: 3rem; border-radius: 1.25rem; height: 56px;">
                </div>
                <?php if (isset($errors['email'])): ?>
                    <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 6px; padding-left: 1rem;"><?= e($errors['email']) ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="margin-bottom: 2.5rem;">
                <label class="form-label">Mot de passe secret</label>
                <div style="position: relative;">
                    <i class="fas fa-shield-keyhole" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="password" name="password" class="form-control" placeholder="8 caractères minimum" required style="padding-left: 3rem; border-radius: 1.25rem; height: 56px;">
                </div>
                <?php if (isset($errors['password'])): ?>
                    <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 6px; padding-left: 1rem;"><?= e($errors['password']) ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 60px; border-radius: 1.5rem; font-size: 1.1rem; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);">
                Rejoindre le service
            </button>
        </form>

        <div style="text-align: center; margin-top: 3rem; color: var(--text-muted); font-size: 1.05rem; font-weight: 500;">
            Déjà inscrit ? 
            <a href="<?= BASE_URL ?>/index.php?action=login" style="color: var(--primary); font-weight: 800; text-decoration: none;">Accédez à votre compte</a>
        </div>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
