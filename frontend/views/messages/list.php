<?php
/**
 * views/messages/list.php — Liste des conversations
 */
$pageTitle = "Ma Messagerie";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-size: 2.25rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 0.5rem; color: var(--text-main);">Discussions</h1>
            <p class="text-muted" style="font-size: 1.1rem;">Échangez avec les autres membres pour les objets perdus ou trouvés.</p>
        </div>
        <div style="width: 48px; height: 48px; background: var(--primary-soft); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
            <i class="fas fa-comment-dots"></i>
        </div>
    </div>

    <?php if (empty($conversations)): ?>
        <div class="card" style="text-align: center; padding: 5rem 3rem; border: 2px dashed #e2e8f0; border-radius: 2rem; background: transparent;">
            <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 2.5rem; color: #cbd5e1; box-shadow: var(--shadow-md);">
                <i class="fas fa-comments"></i>
            </div>
            <h2 style="font-weight: 800; margin-bottom: 1rem;">Pas encore de messages</h2>
            <p class="text-muted" style="max-width: 500px; margin: 0 auto 2.5rem; font-size: 1.1rem;">Contactez les propriétaires d'annonces pour commencer une discussion et organiser la remise de l'objet.</p>
            <a href="<?= BASE_URL ?>/index.php?action=ads" class="btn btn-primary" style="padding: 1rem 2rem; border-radius: 12px;"><i class="fas fa-search"></i> Explorer les annonces</a>
        </div>
    <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <?php foreach ($conversations as $conv): ?>
                <a href="<?= BASE_URL ?>/index.php?action=messages.view&id=<?= $conv['id'] ?>" style="text-decoration: none; display: block; group">
                    <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem; position: relative; border-color: transparent;">
                        <!-- Avatar -->
                        <div style="position: relative;">
                            <div style="width: 64px; height: 64px; background: #e0e7ff; color: var(--primary); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.7rem; font-weight: 800; transform: rotate(-3deg); transition: var(--transition);">
                                <?= strtoupper(substr($conv['other_user_name'], 0, 1)) ?>
                            </div>
                            <?php if ($conv['unread_count'] > 0): ?>
                                <span style="position: absolute; top: -5px; right: -5px; width: 14px; height: 14px; background: var(--danger); border-radius: 50%; border: 3px solid white;"></span>
                            <?php endif; ?>
                        </div>

                        <!-- Info -->
                        <div style="flex: 1; min-width: 0;">
                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 0.5rem;">
                                <h3 style="font-weight: 800; color: var(--text-main); font-size: 1.15rem;"><?= e($conv['other_user_name']) ?></h3>
                                <span class="text-muted" style="font-size: 0.8rem; font-weight: 600;"><?= date('H:i', strtotime($conv['last_message_date'])) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                <p class="text-muted" style="font-size: 0.95rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; margin: 0; font-weight: 500;">
                                    <?= e($conv['last_message_text'] ?: 'Démarrer la conversation...') ?>
                                </p>
                                <?php if ($conv['unread_count'] > 0): ?>
                                    <span style="background: var(--primary); color: white; padding: 2px 10px; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">
                                        <?= $conv['unread_count'] ?> nouveaux
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Arrow -->
                        <div style="color: #cbd5e1; font-size: 1.2rem; transition: var(--transition);">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .card:hover .fa-chevron-right {
        color: var(--primary);
        transform: translateX(5px);
    }
    .card:hover .avatar-chat {
        transform: rotate(0) scale(1.05);
    }
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
