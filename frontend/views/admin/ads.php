<?php
/**
 * views/admin/ads.php — Modération des annonces
 * Variables : $ads (array)
 */
$pageTitle = "Annonces (Admin)";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="admin-ads-page">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Modération des annonces</h1>
        <div class="filters" style="display: flex; gap: 1rem;">
             <select id="ad-filter" class="form-control" style="width: 150px;">
                <option value="">Tous types</option>
                <option value="perdu">Perdus</option>
                <option value="trouvé">Trouvés</option>
             </select>
            <input type="text" id="ad-search" class="form-control" placeholder="Rechercher une annonce..." style="width: 250px;">
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100px;">Photo</th>
                    <th style="width: 250px;">Titre</th>
                    <th>Auteur</th>
                    <th>Ville</th>
                    <th>Type</th>
                    <th>Date pub</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ads as $a): ?>
                    <tr class="ad-row" data-type="<?= strtolower(e($a['type'])) ?>">
                        <td>
                            <?php if ($a['photo_path']): ?>
                                <img src="<?= UPLOADS_URL ?>/<?= e($a['photo_path']) ?>" alt="<?= e($a['title']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            <?php else: ?>
                                <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td style="font-weight: 500;"><?= e($a['title']) ?></td>
                        <td><?= e($a['user_name']) ?></td>
                        <td><?= e($a['city']) ?></td>
                        <td>
                            <span class="badge-status badge-<?= strtolower(e($a['type'])) ?>" style="font-size: 0.7rem;">
                                <?= e(strtoupper($a['type'])) ?>
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 0.85rem;"><?= date('d/m/Y', strtotime($a['created_at'])) ?></td>
                        <td>
                            <span class="badge-status <?= $a['status'] === 'resolved' ? 'badge-resolved' : ($a['type'] === 'lost' ? 'badge-lost' : 'badge-found') ?>">
                                <?= e(ucfirst($a['status'])) ?>
                            </span>
                        </td>
                        <td style="text-align: right;">
                           <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <form action="<?= BASE_URL ?>/index.php?action=admin_ads" method="POST" onsubmit="return confirm('Masquer cette annonce ?')">
                                    <input type="hidden" name="ad_id" value="<?= $a['id'] ?>">
                                    <input type="hidden" name="operation" value="hide">
                                    <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: #475569; border-color: #cbd5e1;" title="Masquer">
                                       <i class="fas fa-eye-slash"></i>
                                    </button>
                                </form>
                                <form action="<?= BASE_URL ?>/index.php?action=admin_ads" method="POST" onsubmit="return confirm('Confirmer la suppression définitive ?')">
                                    <input type="hidden" name="ad_id" value="<?= $a['id'] ?>">
                                    <input type="hidden" name="operation" value="delete">
                                    <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: var(--danger); border-color: #fca5a5;" title="Supprimer">
                                       <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                           </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const filterSelect = document.getElementById('ad-filter');
    const searchInput = document.getElementById('ad-search');
    
    function applyFilters() {
        const type = filterSelect.value.toLowerCase();
        const search = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('.ad-row');
        
        rows.forEach(row => {
            const rowType = row.getAttribute('data-type').toLowerCase();
            const rowText = row.innerText.toLowerCase();
            
            const matchesType = type === "" || rowType === type;
            const matchesSearch = search === "" || rowText.includes(search);
            
            row.style.display = matchesType && matchesSearch ? '' : 'none';
        });
    }

    filterSelect.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);
</script>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
