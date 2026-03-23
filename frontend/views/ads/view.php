<?php
/**
 * views/ads/view.php — Fiche Produit Premium
 */
$pageTitle = e($ad['title']);
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="res-grid" style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1.1fr 1fr; gap: 4rem; position: relative;">
    
    <!-- Zone Image Floating -->
    <div style="position: sticky; top: 120px; align-self: flex-start;" class="res-static">
        <div class="card" style="padding: 0.75rem; border: none; background: white; border-radius: 3rem; box-shadow: var(--shadow-xl); overflow: hidden; position: relative;">
            <div style="width: 100%; height: 550px; border-radius: 2.25rem; overflow: hidden; background: #f8fafc;">
                <?php if ($ad['photo_path']): ?>
                    <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <div style="width: 100%; height: 400px; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 5rem;">
                        <i class="fas fa-camera"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <div style="position: absolute; bottom: 2rem; left: 2rem; display: flex; gap: 0.75rem;">
                <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="font-size: 0.8rem; font-weight: 800; padding: 8px 16px; border: 3px solid white; box-shadow: var(--shadow-md);">
                    <?= strtoupper($ad['type']) ?>
                </span>
                <?php if ($ad['status'] === 'resolved'): ?>
                    <span class="badge-status badge-resolved" style="font-size: 0.8rem; font-weight: 800; padding: 8px 16px; border: 3px solid white; box-shadow: var(--shadow-md);">
                        <i class="fas fa-check-circle"></i> RÉSÕLU
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Zone Contenu High-End -->
    <div style="padding-top: 2rem;">
        <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 2.5rem; margin-bottom: 3rem;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: var(--primary-soft); color: var(--primary); padding: 5px 15px; border-radius: 99px; font-size: 0.75rem; font-weight: 800; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em;">Signalement vérifié</div>
            <h1 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 1.5rem; color: var(--text-main);"><?= e($ad['title']) ?></h1>
            
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div style="width: 44px; height: 44px; background: #e0e7ff; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800;"><?= strtoupper(substr($ad['user_name'], 0, 1)) ?></div>
                    <div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Auteur</div>
                        <div style="font-weight: 800; font-size: 1rem; color: var(--text-main);"><?= e($ad['user_name']) ?></div>
                    </div>
                </div>
                <div style="width: 1px; height: 30px; background: #e2e8f0;"></div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div style="width: 44px; height: 44px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Localisation</div>
                        <div style="font-weight: 800; font-size: 1rem; color: var(--text-main);"><?= e($ad['city']) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 4rem;">
            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; letter-spacing: -0.5px;">Informations clés</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="card" style="padding: 1.5rem; border: none; background: #f8fafc; border-radius: 1.5rem;">
                    <div class="text-muted" style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.1em;">Catégorie</div>
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-main);"><?= ucfirst(e($ad['category'])) ?></div>
                </div>
                <div class="card" style="padding: 1.5rem; border: none; background: #f8fafc; border-radius: 1.5rem;">
                    <div class="text-muted" style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.1em;">Date de l'oubli</div>
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-main);"><?= date('d F Y', strtotime($ad['event_date'])) ?></div>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 4rem;">
            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; letter-spacing: -0.5px;">L'histoire de cet objet</h3>
            <p style="font-size: 1.15rem; line-height: 1.7; color: var(--text-muted); font-weight: 500; white-space: pre-wrap;"><?= e($ad['description']) ?></p>
        </div>

        <!-- Contact UI Pro -->
        <?php if ($canContact): ?>
            <div class="card" style="padding: 3rem; background: linear-gradient(135deg, white, #f8fafc); border: 2px solid var(--primary); border-radius: 2.5rem; overflow: hidden; position: relative;">
                <div style="position: absolute; right: -30px; top: -30px; width: 150px; height: 150px; background: var(--primary-soft); border-radius: 50%; z-index: 0;"></div>
                <div style="position: relative; z-index: 1;">
                     <h3 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">Est-ce le vôtre ?</h3>
                     <p class="text-muted" style="margin-bottom: 2.5rem; font-size: 1.1rem; font-weight: 500;">Ouvrez une discussion sécurisée pour organiser la remise de l'objet en main propre.</p>
                     
                     <form action="<?= BASE_URL ?>/index.php?action=messages.start" method="POST">
                         <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                         <input type="hidden" name="ad_id" value="<?= $ad['id'] ?>">
                         <div class="form-group" style="margin-bottom: 2rem;">
                             <label class="form-label" style="margin-bottom: 1rem;">Votre message</label>
                             <textarea name="message" class="form-control" rows="4" style="background: white; border-radius: 24px; padding: 1.5rem; font-weight: 600; border: 2px solid #f1f5f9;" placeholder="Décrivez pourquoi cet objet pourrait être le vôtre ou comment l'identifier..."></textarea>
                         </div>
                         <button type="submit" class="btn-black-pro">
                             <i class="fas fa-paper-plane" style="margin-right: 10px;"></i> Démarrer la conversation sécurisée
                         </button>
                     </form>
                </div>
            </div>
        <?php elseif (!isLoggedIn()): ?>
            <div class="card" style="padding: 3rem; text-align: center; background: white; border-radius: 2.5rem; border: none; box-shadow: var(--shadow-xl);">
                 <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; color: #94a3b8;"><i class="fas fa-lock"></i></div>
                 <h3 style="font-weight: 800; margin-bottom: 1rem;">Zone sécurisée</h3>
                 <p class="text-muted" style="margin-bottom: 2rem; font-size: 1.1rem;">Connectez-vous pour entrer en contact avec l'auteur du signalement.</p>
                 <a href="<?= BASE_URL ?>/index.php?action=login" class="btn btn-primary" style="padding: 1rem 3rem; border-radius: 99px;">S'identifier</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
