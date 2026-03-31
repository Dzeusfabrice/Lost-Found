<?php
/**
 * views/profile/index.php — Mon Profil Dashboard Pro
 */
$pageTitle = "Mon Espace";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="res-padding">
    <div class="res-flex" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #e0e7ff; color: var(--primary); padding: 4px 12px; border-radius: 99px; font-size: 0.7rem; font-weight: 800; margin-bottom: 0.75rem; text-transform: uppercase;">Centre de contrôle</div>
            <h1 class="h1-res" style="font-size: 3rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 0.5rem; color: var(--text-main);">Bonjour, <span class="text-gradient"><?= e($user['name']) ?>.</span></h1>
            <p class="text-muted" style="font-size: 1.1rem; line-height: 1.6;">Gérez vos annonces et surveillez vos conversations en un seul endroit.</p>
        </div>
        <div style="display: flex; gap: 1rem;">
             <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1rem 2rem; border-radius: 99px;"><i class="fas fa-plus-circle"></i> <span class="res-hide">Publier un signalement</span></a>
             <a href="<?= BASE_URL ?>/index.php?action=logout" class="btn btn-outline" style="width: 50px; height: 50px; padding: 0; border-radius: 50%; color: var(--danger); border-color: rgba(239, 68, 68, 0.2);"><i class="fas fa-power-off"></i></a>
        </div>
    </div>

    <div class="res-grid" style="display: grid; grid-template-columns: 350px 1fr; gap: 4rem; align-items: flex-start;">
        <!-- Card Profil GAUCHE -->
        <div class="res-static" style="position: sticky; top: 120px;">
             <div class="card" style="padding: 3rem 2rem; border: none; background: white; border-radius: 3rem; box-shadow: var(--shadow-xl); text-align: center;">
                 <div style="width: 120px; height: 120px; background: #e0e7ff; border-radius: 50%; margin: 0 auto 2rem; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; font-weight: 800; color: var(--primary); box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.3);">
                     <?= strtoupper(substr($user['name'], 0, 1)) ?>
                 </div>
                 <h2 style="font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -0.5px;"><?= e($user['name']) ?></h2>
                 <p class="text-muted" style="font-weight: 500; margin-bottom: 2.5rem;"><?= e($user['email']) ?></p>
                 
                 <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                     <button class="btn btn-outline" style="width: 100%; border-radius: 99px; font-weight: 700;">Modifier mon profil</button>
                     <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; text-align: left;">
                         <div style="font-size: 0.8rem; font-weight: 800; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.05em; margin-bottom: 1rem;">Statistiques de compte</div>
                         <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                             <span class="text-muted" style="font-weight: 600;">Annonces publiées</span>
                             <span style="font-weight: 800; color: var(--text-main);"><?= count($ads) ?></span>
                         </div>
                         <div style="display: flex; justify-content: space-between;">
                             <span class="text-muted" style="font-weight: 600;">Inscrit depuis</span>
                             <span style="font-weight: 800; color: var(--text-main);"><?= date('M Y', strtotime($user['created_at'])) ?></span>
                         </div>
                     </div>
                 </div>
             </div>
        </div>

        <!-- Liste DROITE -->
        <div>
            <h3 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 2rem; letter-spacing: -1px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-list-ul" style="color: var(--primary);"></i> Mes annonces actives
            </h3>

            <?php if (empty($ads)): ?>
                <div class="card" style="text-align: center; padding: 6rem 3rem; border: 2px dashed #e2e8f0; border-radius: 3rem; background: transparent;">
                    <h4 style="font-weight: 800; margin-bottom: 1rem;">C'est vide par ici...</h4>
                    <p class="text-muted" style="margin-bottom: 2.5rem; font-size: 1.1rem;">Vous n'avez pas encore signalé d'objet sur la plateforme.</p>
                    <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="border-radius: 99px;">Lancer ma première annonce</a>
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <?php foreach ($ads as $ad): ?>
                        <div class="card res-flex" style="padding: 1.25rem; border: none; background: white; border-radius: 2rem; box-shadow: var(--shadow-lg); display: flex; align-items: center; gap: 2rem; transition: var(--transition);">
                            <div style="width: 100px; height: 100px; border-radius: 1.5rem; overflow: hidden; background: #f1f5f9; flex-shrink: 0;">
                                <?php if ($ad['photo_path']): ?>
                                    <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1;"><i class="fas fa-image"></i></div>
                                <?php endif; ?>
                            </div>

                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; gap: 6px; margin-bottom: 0.5rem;">
                                    <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="font-size: 0.55rem; font-weight: 800; padding: 3px 8px;"><?= strtoupper($ad['type']) ?></span>
                                    <span class="badge-status <?= $ad['status'] === 'resolved' ? 'badge-resolved' : 'badge-found' ?>" style="font-size: 0.55rem; font-weight: 800; padding: 3px 8px; border: 1px solid rgba(0,0,0,0.05);"><?= strtoupper($ad['status']) ?></span>
                                </div>
                                <h4 style="font-weight: 800; font-size: 1.25rem; margin-bottom: 0.25rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?= e($ad['title']) ?></h4>
                                <div class="text-muted" style="font-size: 0.85rem; font-weight: 600;"><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> <?= e($ad['city']) ?> • Signalé le <?= date('d.m.Y', strtotime($ad['event_date'])) ?></div>
                            </div>

                            <div style="display: flex; gap: 8px;">
                                <?php if ($ad['status'] === 'open'): ?>
                                    <form action="<?= BASE_URL ?>/index.php?action=ads.status" method="POST">
                                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                                        <input type="hidden" name="id" value="<?= $ad['id'] ?>">
                                        <button type="submit" class="btn" style="width: 44px; height: 44px; background: #d1fae5; color: #10b981; padding: 0; border-radius: 12px; font-size: 1.1rem; border: none; cursor: pointer;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn" style="width: 44px; height: 44px; background: #f1f5f9; color: var(--text-main); padding: 0; border-radius: 12px; font-size: 1.1rem;"><i class="fas fa-eye"></i></a>
                                <a href="<?= BASE_URL ?>/index.php?action=ads.edit&id=<?= $ad['id'] ?>" class="btn" style="width: 44px; height: 44px; background: #e0e7ff; color: var(--primary); padding: 0; border-radius: 12px; font-size: 1.1rem;"><i class="fas fa-edit"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
