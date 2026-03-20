<?php
/**
 * views/admin/users.php — Gestion des utilisateurs
 * Variables : $users (array)
 */
$pageTitle = "Utilisateurs (Admin)";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="admin-users-page">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gestion des utilisateurs</h1>
        <div class="search-box" style="width: 300px;">
            <input type="text" id="user-search" class="form-control" placeholder="Rechercher un utilisateur...">
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 80px;">Avatar</th>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Inscrit le</th>
                    <th>Actif</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr data-user-id="<?= $u['id'] ?>">
                        <td>
                            <div class="avatar-small" style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; color: var(--primary);">
                                <?= strtoupper(substr($u['name'], 0, 1)) ?>
                            </div>
                        </td>
                        <td style="font-weight: 600;"><?= e($u['name']) ?></td>
                        <td><?= e($u['email']) ?></td>
                        <td>
                            <span class="badge" style="position: static; background: <?= $u['role'] === 'admin' ? 'var(--primary)' : 'var(--secondary)' ?>; font-size: 0.7rem; padding: 2px 8px;">
                                <?= e(strtoupper($u['role'])) ?>
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 0.85rem;"><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                        <td>
                            <span class="badge-status <?= $u['is_active'] ? 'badge-resolved' : 'badge-lost' ?>">
                                <?= $u['is_active'] ? 'Actif' : 'Suspendu' ?>
                            </span>
                        </td>
                        <td style="text-align: right; display: flex; gap: 8px; justify-content: flex-end;">
                            <form action="<?= BASE_URL ?>/index.php?action=admin_users" method="POST" style="display: inline;" onsubmit="return confirm('Suspendre cet utilisateur ?')">
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <input type="hidden" name="operation" value="suspend">
                                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: #d97706; border-color: #fcd34d;">
                                   <i class="fas fa-pause"></i> Suspendre
                                </button>
                            </form>
                            <form action="<?= BASE_URL ?>/index.php?action=admin_users" method="POST" style="display: inline;" onsubmit="return confirm('Confirmer la suppression ? Action irréversible.')">
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <input type="hidden" name="operation" value="delete">
                                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: var(--danger); border-color: #fca5a5;">
                                   <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('user-search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
