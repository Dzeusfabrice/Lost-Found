<?php
/**
 * views/ads/list.php — Galerie d'annonces Pro
 */
$pageTitle = "Catalogue d'objets";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="margin-bottom: 4rem;">
    <div class="res-flex res-padding" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; background: white; padding: 2.5rem; border-radius: 2.5rem; box-shadow: var(--shadow-xl); border: 1px solid rgba(226, 232, 240, 0.4);">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #e0e7ff; color: var(--primary); padding: 4px 12px; border-radius: 99px; font-size: 0.7rem; font-weight: 800; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Dernières publications</div>
            <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 0.5rem; color: var(--text-main);">Explorer les <span class="text-gradient">annonces.</span></h1>
            <p class="text-muted" style="font-size: 1.1rem; line-height: 1.6;">Plus de 50 objets signalés cette semaine dans votre communauté.</p>
        </div>
        <div>
            <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 99px;">
                <i class="fas fa-plus-circle"></i> Publier une annonce
            </a>
        </div>
    </div>

    <?php if (empty($ads)): ?>
        <div class="card" style="text-align: center; padding: 6rem; border: none; border-radius: 3rem; box-shadow: var(--shadow-lg);">
            <div style="width: 100px; height: 100px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 3rem; color: #cbd5e1;">
                <i class="fas fa-box-open"></i>
            </div>
            <h2 style="font-weight: 800; margin-bottom: 1rem;">Aucun signalement actuel</h2>
            <p class="text-muted" style="max-width: 450px; margin: 0 auto 2.5rem; font-size: 1.1rem;">La plateforme est toute calme. Profitez-en pour parcourir les autres sections.</p>
            <a href="<?= BASE_URL ?>/index.php?action=search" class="btn btn-outline" style="padding: 1rem 2.5rem; border-radius: 99px;">Lancer une recherche précise</a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
            <?php foreach ($ads as $ad): ?>
                <div class="card" style="padding: 0; background: white; border-radius: 2.5rem; border: none; box-shadow: var(--shadow-lg); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); overflow: hidden; position: relative;">
                    <!-- Floating Type Badge -->
                    <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="position: absolute; top: 20px; right: 20px; z-index: 10; font-size: 0.65rem; font-weight: 800; border: 2px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                        <?= strtoupper($ad['type']) ?>
                    </span>
                    
                    <!-- Preview Image -->
                    <div style="width: 100%; height: 260px; overflow: hidden; position: relative;">
                        <?php if ($ad['photo_path']): ?>
                            <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: var(--transition);">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 3rem;">
                                <i class="fas fa-camera"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Info Area -->
                    <div style="padding: 2rem;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary); font-size: 0.8rem;"></i>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;"><?= e($ad['city']) ?></span>
                        </div>
                        
                        <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 0.75rem; letter-spacing: -0.5px; line-height: 1.2; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?= e($ad['title']) ?></h3>
                        
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; position: relative; line-height: 1.5;">
                             <?= e($ad['description'] ?? '') ?>
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Signalé le</span>
                                <span style="font-size: 0.9rem; font-weight: 800; color: var(--text-main);"><?= date('d.m.Y', strtotime($ad['event_date'])) ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-primary" style="width: 48px; height: 48px; padding: 0; border-radius: 16px; box-shadow: none;">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination Pro -->
        <?php if ($pagination['pages'] > 1): ?>
            <div style="display: flex; justify-content: center; gap: 12px; margin-top: 5rem; align-items: center;">
                <span class="text-muted" style="font-size: 0.9rem; font-weight: 600; margin-right: 1.5rem;">Page <?= $pagination['page'] ?> sur <?= $pagination['pages'] ?></span>
                <?php for($i = 1; $i <= $pagination['pages']; $i++): ?>
                    <a href="<?= BASE_URL ?>/index.php?action=ads&page=<?= $i ?>" 
                       class="btn <?= $i == $pagination['page'] ? 'btn-primary' : 'btn-outline' ?>" 
                       style="width: 44px; height: 44px; padding: 0; border-radius: 14px; box-shadow: <?= $i == $pagination['page'] ? 'var(--shadow-md)' : 'none' ?>;">
                       <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    .card:hover {
        transform: translateY(-8px);
    }
    .card:hover img {
        transform: scale(1.05);
    }
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
