<?php
/**
 * views/ads/create.php — Publier une annonce
 * Variables : $errors (array), $old (array)
 */
$pageTitle = "Publier une annonce";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="max-width: 800px; margin: 2rem auto;">
    <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
        <a href="<?= BASE_URL ?>/index.php?action=ads" class="btn btn-outline" style="border-radius: 50%; width: 40px; height: 40px; padding: 0;"><i class="fas fa-arrow-left"></i></a>
        <h1>Publier une annonce</h1>
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

    <form action="<?= BASE_URL ?>/index.php?action=ads.create" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= getCsrfToken() ?>">
        
        <div class="card" style="padding: 2.5rem; display: flex; flex-direction: column; gap: 2rem;">
            <!-- Type Section -->
            <div class="form-group">
                <label class="form-label" style="font-size: 1.1rem; margin-bottom: 1rem;">Type de signalement</label>
                <div style="display: flex; gap: 1.5rem;">
                    <label style="flex: 1; cursor: pointer;">
                        <input type="radio" name="type" value="lost" class="sr-only" required <?= ($old['type'] ?? 'lost') === 'lost' ? 'checked' : '' ?>>
                        <div class="radio-card" style="padding: 1.5rem; text-align: center; border-radius: 12px; border: 2px solid #e2e8f0; transition: var(--transition);">
                            <i class="fas fa-search" style="font-size: 1.5rem; display: block; margin-bottom: 0.5rem; color: #ef4444;"></i>
                            <span style="font-weight: 700;">J'ai PERDU un objet</span>
                        </div>
                    </label>
                    <label style="flex: 1; cursor: pointer;">
                        <input type="radio" name="type" value="found" class="sr-only" required <?= ($old['type'] ?? '') === 'found' ? 'checked' : '' ?>>
                        <div class="radio-card" style="padding: 1.5rem; text-align: center; border-radius: 12px; border: 2px solid #e2e8f0; transition: var(--transition);">
                            <i class="fas fa-hand-holding-heart" style="font-size: 1.5rem; display: block; margin-bottom: 0.5rem; color: #f59e0b;"></i>
                            <span style="font-weight: 700;">J'ai TROUVÉ un objet</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Basic Info -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Titre de l'annonce</label>
                    <input type="text" name="title" class="form-control" placeholder="Ex: Clés de voiture Toyota" value="<?= e($old['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="category" class="form-control">
                        <option value="accessoires">Accessoires</option>
                        <option value="electronique">Électronique</option>
                        <option value="papiers">Papiers / Documents</option>
                        <option value="vetements">Vêtements</option>
                        <option value="animaux">Animaux</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
            </div>

            <!-- Location & Date -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="city" class="form-control" placeholder="Ex: Paris, Lyon..." value="<?= e($old['city'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Date (Perdu/Trouvé le)</label>
                    <input type="date" name="event_date" class="form-control" value="<?= e($old['event_date'] ?? date('Y-m-d')) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Détails sur l'endroit (Optionnel)</label>
                <input type="text" name="location_details" class="form-control" placeholder="Ex: Métro Ligne 4, Parc de la tête d'or..." value="<?= e($old['location_details'] ?? '') ?>">
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label class="form-label">Photo de l'objet (Recommandé)</label>
                <div style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 2rem; text-align: center; position: relative;">
                    <i class="fas fa-camera" style="font-size: 2rem; color: #94a3b8; display: block; margin-bottom: 1rem;"></i>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Glissez votre photo ici ou cliquez pour parcourir</p>
                    <input type="file" name="photo" style="position: absolute; inset: 0; cursor: pointer; opacity: 0;" accept="image/*">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Description précise</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Décrivez l'objet (couleur, marque, signes distinctifs...) pour faciliter l'identification." required><?= e($old['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 12px;">
                <i class="fas fa-check-circle"></i> Publier mon annonce
            </button>
        </div>
    </form>
</div>

<style>
.sr-only {
    position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;
}
input[type="radio"]:checked + .radio-card {
    border-color: var(--primary);
    background: #fbfcfe;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
}
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
