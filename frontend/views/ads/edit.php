<?php
/**
 * views/ads/edit.php — Modifier une annonce
 * Variables : $errors (array), $old (array)
 */
$pageTitle = "Modifier mon annonce";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="res-padding" style="max-width: 800px; margin: 2rem auto;">
    <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
        <a href="<?= BASE_URL ?>/index.php?action=profile" class="btn btn-outline" style="border-radius: 50%; width: 40px; height: 40px; padding: 0;"><i class="fas fa-arrow-left"></i></a>
        <h1>Modifier l'annonce</h1>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="card" style="background: #fee2e2; border-color: #fca5a5; margin-bottom: 2rem; padding: 1.5rem;">
            <ul style="color: #ef4444; font-weight: 600;">
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/index.php?action=ads.edit&id=<?= $old['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
        
        <div class="card" style="padding: 2.5rem; display: flex; flex-direction: column; gap: 2rem;">
            <!-- Info type -->
             <div class="res-flex" style="display: flex; gap: 1.5rem; align-items: center; padding: 1.5rem; background: #f8fafc; border-radius: 24px; border: 1px solid #f1f5f9; margin-bottom: 2rem;">
                  <div style="width: 48px; height: 48px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.25rem; box-shadow: var(--shadow-sm); flex-shrink: 0;">
                      <i class="fas fa-info-circle"></i>
                  </div>
                  <div>
                      <span class="badge-status badge-<?= strtolower(e($old['type'])) ?>" style="font-size: 0.65rem; padding: 4px 10px;"><?= strtoupper($old['type']) ?></span>
                      <p class="text-muted" style="margin: 0.25rem 0 0; font-size: 0.85rem; font-weight: 600;">Le type d'annonce ne peut pas être modifié après publication.</p>
                  </div>
             </div>

            <!-- Basic Info -->
            <div class="res-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Titre de l'annonce</label>
                    <div class="input-group-pro">
                        <i class="fas fa-pencil-alt main-icon"></i>
                        <input type="text" name="title" class="form-control-pro" value="<?= e($old['title']) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <div class="input-group-pro">
                        <i class="fas fa-th-large main-icon" style="z-index: 10;"></i>
                        <select name="category" class="form-control-pro" style="appearance: none;">
                            <option value="accessoires" <?= $old['category'] === 'accessoires' ? 'selected' : '' ?>>Accessoires</option>
                            <option value="electronique" <?= $old['category'] === 'electronique' ? 'selected' : '' ?>>Électronique</option>
                            <option value="papiers" <?= $old['category'] === 'papiers' ? 'selected' : '' ?>>Papiers / Documents</option>
                            <option value="vetements" <?= $old['category'] === 'vetements' ? 'selected' : '' ?>>Vêtements</option>
                            <option value="animaux" <?= $old['category'] === 'animaux' ? 'selected' : '' ?>>Animaux</option>
                            <option value="autre" <?= $old['category'] === 'autre' ? 'selected' : '' ?>>Autre</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Location & Date -->
            <div class="res-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <div class="input-group-pro">
                        <i class="fas fa-map-marker-alt main-icon"></i>
                        <input type="text" name="city" class="form-control-pro" value="<?= e($old['city']) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <div class="input-group-pro">
                        <i class="fas fa-calendar-day main-icon"></i>
                        <input type="date" name="event_date" class="form-control-pro" value="<?= e($old['event_date']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Détails sur l'endroit</label>
                <div class="input-group-pro">
                    <i class="fas fa-location-arrow main-icon"></i>
                    <input type="text" name="location_details" class="form-control-pro" value="<?= e($old['location_details'] ?? '') ?>">
                </div>
            </div>

            <!-- Photo Current -->
            <div class="form-group">
                <label class="form-label">Gestion de la photo</label>
                <div class="res-flex" style="display: flex; gap: 2rem; align-items: center; padding: 2rem; background: #f8fafc; border-radius: 24px;">
                     <div style="width: 120px; height: 120px; border-radius: 18px; overflow: hidden; background: white; box-shadow: var(--shadow-sm); border: 4px solid white;">
                         <?php if ($old['photo_path']): ?>
                             <img src="<?= UPLOADS_URL ?>/<?= e($old['photo_path']) ?>" alt="Aperçu" style="width: 100%; height: 100%; object-fit: cover;">
                         <?php else: ?>
                             <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 2rem;"><i class="fas fa-camera"></i></div>
                         <?php endif; ?>
                     </div>
                     <div style="flex: 1;">
                         <label class="btn btn-outline" style="cursor: pointer; position: relative; border-radius: 99px; padding: 0.75rem 1.5rem; font-weight: 700;">
                             <i class="fas fa-sync-alt" style="margin-right: 8px;"></i> Remplacer la photo
                             <input type="file" name="photo" style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" accept="image/*">
                         </label>
                         <p class="text-muted" style="font-size: 0.8rem; margin-top: 1rem; font-weight: 600;">Laissez vide pour conserver l'image actuelle.</p>
                     </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Description précise</label>
                <textarea name="description" class="form-control" rows="6" style="border-radius: 24px; padding: 1.5rem; background: #f8fafc; border: none; font-weight: 600;"><?= e($old['description']) ?></textarea>
            </div>

            <button type="submit" class="btn-black-pro" style="margin-top: 2rem;">
                <i class="fas fa-save" style="margin-right: 10px;"></i> Enregistrer les modifications de l'annonce
            </button>
        </div>
    </form>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
