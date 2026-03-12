<?php
$pageTitle = "Modération des annonces";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
    <h1><i class="fas fa-tasks"></i> Modération des annonces</h1>
    <a href="<?= BASE_URL ?>/index.php?action=admin" class="btn btn-outline">Retour Dashboard</a>
</div>

<div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); border: 1px solid #e2e8f0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
            <tr>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Annonce</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Auteur</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Type / Statut</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600;">Date</th>
                <th style="padding: 1rem 1.5rem; color: var(--text-muted); font-weight: 600; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as $ad): ?>
                <tr style="border-bottom: 1px solid #f1f5f9; background: <?= $ad['is_hidden'] ? '#fff7ed' : 'transparent' ?>;">
                    <td style="padding: 1rem 1.5rem;">
                        <div style="font-weight: 600;"><?= e($ad['title']) ?></div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);"><?= e($ad['city']) ?> (<?= e($ad['category']) ?>)</div>
                    </td>
                    <td style="padding: 1rem 1.5rem; font-size: 0.9rem;">
                        <span style="color: var(--text-main);"><?= e($ad['user_name']) ?></span>
                    </td>
                    <td style="padding: 1rem 1.5rem;">
                        <div style="display: flex; gap: 5px;">
                            <span style="font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; background: <?= $ad['type'] === 'lost' ? '#fee2e2' : '#fef3c7' ?>; color: <?= $ad['type'] === 'lost' ? '#ef4444' : '#f59e0b' ?>;">
                                <?= strtoupper($ad['type']) ?>
                            </span>
                            <span style="font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; background: <?= $ad['status'] === 'resolved' ? '#dcfce7' : '#f1f5f9' ?>; color: <?= $ad['status'] === 'resolved' ? '#10b981' : '#64748b' ?>;">
                                <?= strtoupper($ad['status']) ?>
                            </span>
                        </div>
                    </td>
                    <td style="padding: 1rem 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
                        <?= date('d/m/Y', strtotime($ad['created_at'])) ?>
                    </td>
                    <td style="padding: 1rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <form action="<?= BASE_URL ?>/index.php?action=admin.hide.ad" method="POST">
                                <?= csrfField() ?>
                                <input type="hidden" name="id" value="<?= $ad['id'] ?>">
                                <input type="hidden" name="hidden" value="<?= $ad['is_hidden'] ? '0' : '1' ?>">
                                <button type="submit" class="btn btn-outline" title="<?= $ad['is_hidden'] ? 'Afficher' : 'Masquer' ?>" style="padding: 6px 10px; font-size: 0.8rem;">
                                    <i class="fas <?= $ad['is_hidden'] ? 'fa-eye' : 'fa-eye-slash' ?>"></i>
                                </button>
                            </form>
                            
                            <form action="<?= BASE_URL ?>/index.php?action=admin.delete.ad" method="POST">
                                <?= csrfField() ?>
                                <input type="hidden" name="id" value="<?= $ad['id'] ?>">
                                <button type="submit" class="btn btn-outline btn-confirm" style="padding: 6px 10px; font-size: 0.8rem; color: var(--danger);">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            
                            <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-outline" style="padding: 6px 10px; font-size: 0.8rem;">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
