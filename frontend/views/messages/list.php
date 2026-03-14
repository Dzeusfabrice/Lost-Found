<?php
$pageTitle = "Mes conversations";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="messages-header" style="margin-bottom: 2rem;">
    <h1><i class="fas fa-comments"></i> Mes messages</h1>
    <p style="color: var(--text-muted);">Retrouvez ici vos discussions concernant vos annonces ou vos recherches.</p>
</div>

<?php if (empty($conversations)): ?>
    <div style="text-align: center; padding: 4rem; background: white; border-radius: var(--radius); border: 1px solid #e2e8f0;">
        <i class="fas fa-comment-slash" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
        <h3 style="color: var(--text-muted);">Aucune conversation pour le moment</h3>
        <p>Contactez un membre depuis son annonce pour démarrer une discussion.</p>
        <a href="<?= BASE_URL ?>/index.php?action=ads" class="btn btn-primary" style="margin-top: 1.5rem;">Parcourir les annonces</a>
    </div>
<?php else: ?>
    <div class="conv-list" style="display: flex; flex-direction: column; gap: 1rem;">
        <?php foreach ($conversations as $conv): 
            $isUser1 = ($conv['user1_id'] == $_SESSION['user_id']);
            $otherUserName = $isUser1 ? $conv['user2_name'] : $conv['user1_name'];
            $isUnread = ($conv['unread_count'] > 0);
        ?>
            <a href="<?= BASE_URL ?>/index.php?action=messages.view&id=<?= $conv['id'] ?>" 
               style="text-decoration: none; color: inherit; display: flex; align-items: center; padding: 1.25rem; background: white; border-radius: var(--radius); border: 1px solid <?= $isUnread ? 'var(--primary)' : '#e2e8f0' ?>; transition: var(--transition); box-shadow: <?= $isUnread ? 'var(--shadow-md)' : 'var(--shadow-sm)' ?>;">
                
                <!-- Avatar fictif -->
                <div style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin-right: 1.25rem; font-weight: 700; color: var(--primary);">
                    <?= strtoupper(substr($otherUserName, 0, 1)) ?>
                </div>

                <!-- Infos -->
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                        <h4 style="margin: 0; font-weight: <?= $isUnread ? '700' : '600' ?>; color: var(--text-main);">
                            <?= e($otherUserName) ?>
                        </h4>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">
                            <?= date('d/m/Y H:i', strtotime($conv['last_message_at'] ?? $conv['created_at'])) ?>
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p style="margin: 0; font-size: 0.9rem; color: <?= $isUnread ? 'var(--text-main)' : 'var(--text-muted)' ?>; font-weight: <?= $isUnread ? '600' : '400' ?>; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 80%;">
                            <span style="color: var(--primary); font-size: 0.8rem; font-weight: 700;">Re: <?= e($conv['ad_title']) ?></span> – <?= e($conv['last_message'] ?? 'Aucun message...') ?>
                        </p>
                        <?php if ($isUnread): ?>
                            <span class="badge" style="position: relative; top: 0; right: 0; padding: 4px 8px; font-weight: 700;"><?= $conv['unread_count'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <i class="fas fa-chevron-right" style="margin-left: 1rem; color: #cbd5e1;"></i>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
