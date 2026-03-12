<?php
$pageTitle = "Gestion des comptes";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
    <h1><i class="fas fa-users"></i> Gestion des utilisateurs</h1>
    <a href="<?= BASE_URL ?>/index.php?action=admin" class="btn btn-outline">Retour Dashboard</a>
</div>

<div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); border: 1px solid #e2e8f0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
            <tr>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Utilisateur</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Rôle</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Statut</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Inscrit le</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr style="border-bottom: 1px solid #f1f5f9; transition: var(--transition);">
                    <td style="padding: 1rem 1.5rem;">
                        <div style="font-weight: 600;"><?= e($user['name']) ?></div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);"><?= e($user['email']) ?></div>
                    </td>
                    <td style="padding: 1rem 1.5rem;">
                        <span style="font-size: 0.75rem; padding: 4px 8px; border-radius: 4px; font-weight: 600; 
                            background: <?= $user['role'] === 'admin' ? '#e0e7ff' : '#f1f5f9' ?>; 
                            color: <?= $user['role'] === 'admin' ? '#4338ca' : '#64748b' ?>;">
                            <?= strtoupper($user['role']) ?>
                        </span>
                    </td>
                    <td style="padding: 1rem 1.5rem;">
                        <?php if ($user['is_active']): ?>
                            <span style="color: var(--success);"><i class="fas fa-check-circle"></i> Actif</span>
                        <?php else: ?>
                            <span style="color: var(--danger);"><i class="fas fa-ban"></i> Suspendu</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 1rem 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
                        <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                    </td>
                    <td style="padding: 1rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <form action="<?= BASE_URL ?>/index.php?action=admin.suspend" method="POST">
                                <?= csrfField() ?>
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="active" value="<?= $user['is_active'] ? '0' : '1' ?>">
                                <button type="submit" class="btn btn-outline" style="padding: 6px 10px; font-size: 0.8rem;">
                                    <?= $user['is_active'] ? 'Suspendre' : 'Activer' ?>
                                </button>
                            </form>
                            
                            <form action="<?= BASE_URL ?>/index.php?action=admin.delete.user" method="POST">
                                <?= csrfField() ?>
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" class="btn btn-outline btn-confirm" style="padding: 6px 10px; font-size: 0.8rem; color: var(--danger); border-color: #fee2e2;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
