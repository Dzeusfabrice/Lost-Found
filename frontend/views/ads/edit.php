<?php
/**
 * views/ads/edit.php — Modifier une annonce
 * Variables : $errors (array), $old (array)
 */
$pageTitle = "Modifier mon annonce";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="max-width: 800px; margin: 2rem auto;">
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
        <input type="hidden" name="csrf_token" value="<?= getCsrfToken() ?>">
        
        <div class="card" style="padding: 2.5rem; display: flex; flex-direction: column; gap: 2rem;">
            <!-- Info type (non modifiable pour la cohérence ?) -->
            <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: #f8fafc; border-radius: 8px;">
                 <span class="badge-status badge-<?= strtolower(e($old['type'])) ?>"><?= strtoupper($old['type']) ?></span>
                 <p class="text-muted" style="margin: 0; font-size: 0.9rem;">Le type d'annonce (Perdu/Trouvé) ne peut pas être modifié après publication.</p>
            </div>

            <!-- Basic Info -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Titre de l'annonce</label>
                    <input type="text" name="title" class="form-control" placeholder="Ex: Clés de voiture Toyota" value="<?= e($old['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="category" class="form-control">
                        <option value="accessoires" <?= $old['category'] === 'accessoires' ? 'selected' : '' ?>>Accessoires</option>
                        <option value="electronique" <?= $old['category'] === 'electronique' ? 'selected' : '' ?>>Électronique</option>
                        <option value="papiers" <?= $old['category'] === 'papiers' ? 'selected' : '' ?>>Papiers / Documents</option>
                        <option value="vetements" <?= $old['category'] === 'vetements' ? 'selected' : '' ?>>Vêtements</option>
                        <option value="animaux" <?= $old['category'] === 'animaux' ? 'selected' : '' ?>>Animaux</option>
                        <option value="autre" <?= $old['category'] === 'autre' ? 'selected' : '' ?>>Autre</option>
                    </select>
                </div>
            </div>

            <!-- Location & Date -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="city" class="form-control" placeholder="Ex: Paris, Lyon..." value="<?= e($old['city']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Date (Perdu/Trouvé le)</label>
                    <input type="date" name="event_date" class="form-control" value="<?= e($old['event_date']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Détails sur l'endroit (Optionnel)</label>
                <input type="text" name="location_details" class="form-control" placeholder="Ex: Métro Ligne 4..." value="<?= e($old['location_details'] ?? '') ?>">
            </div>

            <!-- Photo Current -->
            <div class="form-group">
                <label class="form-label">Photo actuelle</label>
                <div style="display: flex; gap: 1rem; align-items: flex-end;">
                     <div style="width: 120px; height: 120px; border-radius: 8px; overflow: hidden; background: #f1f5f9;">
                         <?php if ($old['photo_path']): ?>
                             <img src="<?= UPLOADS_URL ?>/<?= e($old['photo_path']) ?>" alt="Aperçu" style="width: 100%; height: 100%; object-fit: cover;">
                         <?php else: ?>
                             <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1;"><i class="fas fa-image"></i></div>
                         <?php endif; ?>
                     </div>
                     <div style="flex: 1;">
                         <label class="btn btn-outline" style="cursor: pointer; position: relative;">
                             <i class="fas fa-upload"></i> Remplacer la photo
                             <input type="file" name="photo" style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" accept="image/*">
                         </label>
                         <p class="text-muted" style="font-size: 0.8rem; margin-top: 0.5rem;">Laissez vide pour conserver la photo actuelle.</p>
                     </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Description précise</label>
                <textarea name="description" class="form-control" rows="5" required><?= e($old['description']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 12px;">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
