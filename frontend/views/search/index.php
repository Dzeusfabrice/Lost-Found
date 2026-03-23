<?php
/**
 * views/search/index.php — Moteur de Recherche Pro
 */
$pageTitle = "Trouver un objet";
require VIEWS_PATH . '/layouts/header.php';

// Valeurs par défaut pour les filtres
$q      = e($_GET['q'] ?? '');
$type   = e($_GET['type'] ?? '');
$city   = e($_GET['city'] ?? '');
?>

<div class="res-padding" style="max-width: 1100px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 4rem;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: #e0e7ff; color: var(--primary); padding: 4px 12px; border-radius: 99px; font-size: 0.7rem; font-weight: 800; margin-bottom: 1.5rem; text-transform: uppercase;">Interface de recherche intelligente</div>
        <h1 class="h1-res" style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 1rem; color: var(--text-main);">Qu'avez-vous <span class="text-gradient">perdu ?</span></h1>
        <p class="text-muted" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto; line-height: 1.5;">Utilisez les filtres multicritères ci-dessous pour localiser rapidement votre objet dans notre base de données.</p>
    </div>

    <!-- Moteur de Recherche Stylisé -->
    <div class="card" style="padding: 2.5rem; margin-bottom: 5rem; border: none; border-radius: 3rem; background: white; box-shadow: var(--shadow-xl);">
        <form action="<?= BASE_URL ?>/index.php" method="GET" class="res-grid" style="display: grid; grid-template-columns: 2fr 1fr 1fr 100px; gap: 1rem; align-items: flex-end;">
            <input type="hidden" name="action" value="search">
            
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.1em; padding-left: 1rem;">Mots clés</label>
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="text" name="q" class="form-control" placeholder="Clés, Portefeuille, Sac..." value="<?= $q ?>" style="border-radius: 1.5rem; padding-left: 3.5rem; height: 56px;">
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.1em; padding-left: 1rem;">Filtrer par type</label>
                <div style="position: relative;">
                    <i class="fas fa-tag" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1; z-index: 10;"></i>
                    <select name="type" class="form-control" style="border-radius: 1.5rem; padding-left: 3.5rem; height: 56px; appearance: none;">
                        <option value="">Tous les objets</option>
                        <option value="lost" <?= $type === 'lost' ? 'selected' : '' ?>>Objets perdus</option>
                        <option value="found" <?= $type === 'found' ? 'selected' : '' ?>>Objets trouvés</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.1em; padding-left: 1rem;">Ville / Secteur</label>
                <div style="position: relative;">
                    <i class="fas fa-map-marker-alt" style="position: absolute; left: 20px; top: 18px; color: #cbd5e1;"></i>
                    <input type="text" name="city" class="form-control" placeholder="Lyon, Paris..." value="<?= $city ?>" style="border-radius: 1.5rem; padding-left: 3.5rem; height: 56px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 64px; height: 56px; padding: 0; border-radius: 1.5rem; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);">
                <i class="fas fa-search" style="font-size: 1.25rem;"></i>
            </button>
        </form>
    </div>

    <!-- Résultats Pro -->
    <div style="margin-top: 4rem;">
        <?php if (empty($ads)): ?>
            <?php if (!empty($_GET)): ?>
                <div style="text-align: center; padding: 6rem 1rem; background: rgba(226, 232, 240, 0.2); border-radius: 3rem; border: 2px dashed #e2e8f0;">
                    <h2 style="font-weight: 800; margin-bottom: 1rem;">Désolé, aucun résultat trouvé.</h2>
                    <p class="text-muted" style="margin-bottom: 2.5rem; font-size: 1.1rem; max-width: 400px; margin-left: auto; margin-right: auto;">Essayez d'élargir vos critères de recherche ou de retirer certains filtres.</p>
                    <a href="<?= BASE_URL ?>/index.php?action=search" class="btn btn-outline" style="border-radius: 99px; padding: 0.8rem 2.5rem;">Réinitialiser la recherche</a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; padding-left: 1.5rem;">
                 <h3 style="font-weight: 800; color: var(--text-main); font-size: 1.5rem;"><i class="fas fa-layer-group" style="color: var(--primary);"></i> <?= count($ads) ?> résultats pertinents</h3>
                 <div class="text-muted" style="font-weight: 600; font-size: 0.9rem;">Trié par pertinence temporelle</div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2.5rem;">
                <?php foreach ($ads as $ad): ?>
                    <div class="card" style="padding: 0; border: none; background: white; border-radius: 2.5rem; box-shadow: var(--shadow-lg); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); overflow: hidden; position: relative;">
                         <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="position: absolute; top: 15px; right: 15px; z-index: 10; font-size: 0.6rem; font-weight: 800; border: 2px solid white;"><?= strtoupper($ad['type']) ?></span>
                         
                         <div style="width: 100%; height: 240px; overflow: hidden; position: relative;">
                            <?php if ($ad['photo_path']): ?>
                                <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 3rem;">
                                    <i class="fas fa-camera"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div style="padding: 2rem;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                                <i class="fas fa-map-marker-alt" style="color: var(--primary); font-size: 0.8rem;"></i>
                                <span style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;"><?= e($ad['city']) ?></span>
                            </div>
                            
                            <h4 style="font-size: 1.3rem; font-weight: 800; margin-bottom: 2rem; line-height: 1.2; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?= e($ad['title']) ?></h4>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-main);"><?= date('d M Y', strtotime($ad['event_date'])) ?></span>
                                <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-primary" style="width: 44px; height: 44px; padding: 0; border-radius: 12px; box-shadow: none;">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Style -->
            <?php if ($pagination['pages'] > 1): ?>
                <div style="display: flex; justify-content: center; gap: 10px; margin-top: 5rem;">
                    <?php for($i = 1; $i <= $pagination['pages']; $i++): ?>
                        <a href="<?= BASE_URL ?>/index.php?action=search&page=<?= $i ?>&q=<?= $q ?>&type=<?= $type ?>&city=<?= $city ?>" 
                           class="btn <?= $i == $pagination['page'] ? 'btn-primary' : 'btn-outline' ?>" 
                           style="width: 44px; height: 44px; padding: 0; border-radius: 14px;"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    card:hover { transform: translateY(-10px); }
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
