<?php
/**
 * views/ads/create.php — Publier une annonce
 * Variables : $errors (array), $old (array)
 */
$pageTitle = "Publier une annonce";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="res-padding" style="max-width: 800px; margin: 2rem auto;">
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
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
        
        <div class="card" style="padding: 2.5rem; display: flex; flex-direction: column; gap: 2rem;">
            <!-- Type Section -->
            <div class="form-group">
                <label class="form-label">Que souhaitez-vous faire ?</label>
                <div style="display: flex; gap: 1.5rem;">
                    <label style="flex: 1; cursor: pointer;">
                        <input type="radio" name="type" value="lost" class="sr-only" required <?= ($old['type'] ?? 'lost') === 'lost' ? 'checked' : '' ?>>
                        <div class="radio-card" style="padding: 2rem; text-align: center; border-radius: 24px; border: 2px solid #f1f5f9; background: #f8fafc; transition: var(--transition);">
                            <div style="width: 50px; height: 50px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.2rem;">
                                <i class="fas fa-search"></i>
                            </div>
                            <span style="font-weight: 800; color: #1e293b;">J'ai PERDU un objet</span>
                        </div>
                    </label>
                    <label style="flex: 1; cursor: pointer;">
                        <input type="radio" name="type" value="found" class="sr-only" required <?= ($old['type'] ?? '') === 'found' ? 'checked' : '' ?>>
                        <div class="radio-card" style="padding: 2rem; text-align: center; border-radius: 24px; border: 2px solid #f1f5f9; background: #f8fafc; transition: var(--transition);">
                            <div style="width: 50px; height: 50px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.2rem;">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <span style="font-weight: 800; color: #1e293b;">J'ai TROUVÉ un objet</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Basic Info -->
            <div class="res-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Titre de l'objet</label>
                    <div class="input-group-pro">
                        <i class="fas fa-pencil-alt main-icon"></i>
                        <input type="text" name="title" class="form-control-pro" placeholder="Ex: iPhone 13 Pro Noir" value="<?= e($old['title'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <div class="input-group-pro">
                         <i class="fas fa-th-large main-icon" style="z-index: 10;"></i>
                        <select name="category" class="form-control-pro" style="appearance: none;">
                            <option value="accessoires">Accessoires</option>
                            <option value="electronique">Électronique</option>
                            <option value="papiers">Papiers / Documents</option>
                            <option value="vetements">Vêtements</option>
                            <option value="animaux">Animaux</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Location & Date -->
            <div class="res-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ville de l'évènement</label>
                    <div class="input-group-pro">
                        <i class="fas fa-map-marker-alt main-icon"></i>
                        <input type="text" name="city" class="form-control-pro" placeholder="Ex: Lyon, 69002" value="<?= e($old['city'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Date précise</label>
                    <div class="input-group-pro">
                        <i class="fas fa-calendar-day main-icon"></i>
                        <input type="date" name="event_date" class="form-control-pro" value="<?= e($old['event_date'] ?? date('Y-m-d')) ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Précisions sur le lieu (Optionnel)</label>
                <div class="input-group-pro">
                    <i class="fas fa-location-arrow main-icon"></i>
                    <input type="text" name="location_details" class="form-control-pro" placeholder="Ex: Quai de la gare, Place Bellecour..." value="<?= e($old['location_details'] ?? '') ?>">
                </div>
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label class="form-label">Photo de l'objet</label>
                <div style="border: 3px dashed #f1f5f9; border-radius: 24px; padding: 3rem; text-align: center; position: relative; background: #f8fafc; transition: var(--transition);" class="upload-zone">
                    <div style="width: 60px; height: 60px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--primary); font-size: 1.5rem; box-shadow: var(--shadow-sm);">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <p style="color: #64748b; font-weight: 700; font-size: 1rem; margin-bottom: 0.5rem;">Cliquez pour uploader une photo</p>
                    <p style="color: #94a3b8; font-size: 0.85rem;">PNG, JPG ou WEBP jusqu'à 5 Mo</p>
                    <input type="file" name="photo" style="position: absolute; inset: 0; cursor: pointer; opacity: 0;" accept="image/*">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Description détaillée</label>
                <textarea name="description" class="form-control" rows="6" style="border-radius: 24px; padding: 1.5rem; background: #f8fafc; border: none; font-weight: 600;" placeholder="Donnez le maximum de détails (marque, rayures, signes particuliers...) pour aider à l'identification." required><?= e($old['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn-black-pro" style="margin-top: 2rem;">
                <i class="fas fa-paper-plane" style="margin-right: 10px;"></i> Confirmer et publier l'annonce
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
    background: white !important;
    box-shadow: 0 20px 40px -10px rgba(79, 70, 229, 0.15);
}
input[type="radio"]:checked + .radio-card div {
    background: var(--primary) !important;
    color: white !important;
}
.upload-zone:hover {
    border-color: var(--primary-light);
    background: white;
}
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
