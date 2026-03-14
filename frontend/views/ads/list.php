<?php
$pageTitle = "Toutes les annonces";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem;">
    <div>
        <h1 style="font-size: 2rem; color: var(--text-main); margin-bottom: 0.5rem;">Annonces récentes</h1>
        <p style="color: var(--text-muted);">Derniers objets signalés près de chez vous.</p>
    </div>
    <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Publier une annonce
    </a>
</div>

<?php if (empty($ads)): ?>
    <div style="text-align: center; padding: 5rem 0; background: white; border-radius: var(--radius); border: 1px dashed var(--secondary);">
        <i class="fas fa-box-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
        <h3 style="color: var(--text-muted);">Aucune annonce trouvée</h3>
        <p>Soyez le premier à signaler un objet !</p>
    </div>
<?php else: ?>
    <!-- Grille Responsive -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
        <?php foreach ($ads as $ad): ?>
            <div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); transition: var(--transition); border: 1px solid #f1f5f9;">
                <!-- Image -->
                <?php if ($ad['photo_path']): ?>
                    <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 200px; object-fit: cover;">
                <?php else: ?>
                    <div style="width: 100%; height: 200px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                        <i class="fas fa-image" style="font-size: 2rem;"></i>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div style="padding: 1.25rem;">
                    <div style="display: flex; gap: 8px; margin-bottom: 0.75rem;">
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; padding: 2px 8px; border-radius: 99px; 
                            background: <?= $ad['type'] === 'lost' ? '#fee2e2' : '#fef3c7' ?>; 
                            color: <?= $ad['type'] === 'lost' ? '#ef4444' : '#f59e0b' ?>;">
                            <?= $ad['type'] === 'lost' ? 'Perdu' : 'Trouvé' ?>
                        </span>
                        
                        <?php if ($ad['status'] === 'resolved'): ?>
                            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; padding: 2px 8px; border-radius: 99px; background: #dcfce7; color: var(--success);">
                                Résolu
                            </span>
                        <?php endif; ?>
                    </div>

                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                        <?= e($ad['title']) ?>
                    </h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 4px; color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1.25rem;">
                        <span><i class="fas fa-map-marker-alt" style="width: 16px;"></i> <?= e($ad['city']) ?></span>
                        <span><i class="fas fa-calendar-alt" style="width: 16px;"></i> <?= date('d/m/Y', strtotime($ad['event_date'])) ?></span>
                    </div>

                    <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-outline" style="width: 100%;">
                        Voir les détails
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
