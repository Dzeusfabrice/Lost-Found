<?php
/**
 * views/messages/view.php — Chat View Pro
 */
$pageTitle = "Discussion avec " . e($otherUser['name'] ?? 'Utilisateur');
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="res-flex" style="max-width: 1000px; margin: 0 auto; display: flex; gap: 2rem; align-items: flex-start; min-height: calc(100vh - 200px);">
    
    <!-- Sidebar Annonce -->
    <div class="res-hide" style="flex: 1; position: sticky; top: 100px;">
        <div class="card" style="padding: 1.5rem; border: none; background: white; border-radius: 2rem; box-shadow: var(--shadow-xl);">
            <div style="margin-bottom: 2rem; text-align: center;">
                <div style="width: 100%; height: 150px; background: #f1f5f9; border-radius: 1.5rem; overflow: hidden; margin-bottom: 1.5rem; position: relative;">
                    <?php if ($ad['photo_path']): ?>
                        <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 2rem;">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="position: absolute; top: 12px; right: 12px; font-size: 0.65rem; font-weight: 800; border: 2px solid white; box-shadow: var(--shadow-sm);">
                        <?= strtoupper($ad['type']) ?>
                    </span>
                </div>
                <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -0.5px;"><?= e($ad['title']) ?></h2>
                <div class="text-muted" style="font-size: 0.85rem; font-weight: 600;"><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> <?= e($ad['city']) ?></div>
            </div>

            <div style="padding-top: 1.5rem; border-top: 1px solid #f1f5f9; display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 44px; height: 44px; background: #e0e7ff; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 800;">
                        <?= strtoupper(substr($otherUser['name'], 0, 1)) ?>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.95rem;"><?= e($otherUser['name']) ?></div>
                        <div class="text-muted" style="font-size: 0.75rem; font-weight: 600;">En ligne récemment</div>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-outline" style="width: 100%; font-size: 0.85rem; border-radius: 99px;">Voir l'annonce complète</a>
            </div>
        </div>
    </div>

    <!-- Zone Chat Chat -->
    <div class="chat-window" style="flex: 2; height: 600px; display: flex; flex-direction: column; background: white; border-radius: 2.5rem; box-shadow: var(--shadow-xl); overflow: hidden; border: 1px solid rgba(226, 232, 240, 0.4);">
        <!-- Header Chat -->
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; background: white; display: flex; justify-content: space-between; align-items: center; z-index: 10;">
             <div style="display: flex; align-items: center; gap: 12px;">
                 <div style="width: 10px; height: 10px; background: var(--success); border-radius: 50%; box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);"></div>
                 <h3 style="font-weight: 800; font-size: 1.1rem;">Fil de discussion</h3>
             </div>
             <div style="display: flex; gap: 10px; color: var(--text-muted);">
                 <i class="fas fa-search"></i>
                 <i class="fas fa-ellipsis-v"></i>
             </div>
        </div>

        <!-- Messages scrollables -->
        <div id="chat-messages" style="flex: 1; overflow-y: auto; padding: 2rem; background: #fbfcfe; display: flex; flex-direction: column; gap: 1rem;">
            <?php foreach ($messages as $m): ?>
                <?php $isMine = (int)$m['sender_id'] === currentUserId(); ?>
                <div style="display: flex; justify-content: <?= $isMine ? 'flex-end' : 'flex-start' ?>;">
                    <div style="max-width: 75%;">
                        <div class="message-bubble <?= $isMine ? 'message-sent' : 'message-received' ?>" style="font-weight: 500; font-size: 0.95rem; padding: 1rem 1.25rem; border-radius: <?= $isMine ? '20px 20px 4px 20px' : '20px 20px 20px 4px' ?>;">
                            <?= e($m['body']) ?>
                        </div>
                        <div class="text-muted" style="font-size: 0.65rem; text-align: <?= $isMine ? 'right' : 'left' ?>; padding-top: 4px; font-weight: 600;">
                            <?= date('H:i', strtotime($m['created_at'])) ?> <?= $isMine ? '• Vu' : '' ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Zone Formulaire -->
        <div style="padding: 1.5rem 2rem; background: white; border-top: 1px solid #f1f5f9;">
            <form action="<?= BASE_URL ?>/index.php?action=messages.send" method="POST" style="display: flex; gap: 12px; align-items: center;">
                <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                <input type="hidden" name="conversation_id" value="<?= $convId ?>">
                <div style="flex: 1; position: relative;">
                    <textarea name="body" class="form-control" rows="1" placeholder="Écrivez votre message..." required style="border-radius: 99px; padding: 0.85rem 1.5rem; min-height: 50px; resize: none; overflow: hidden; border: 2px solid #f1f5f9; background: #f8fafc; font-weight: 500;"></textarea>
                    <div style="position: absolute; right: 15px; top: 12px; color: #cbd5e1; display: flex; gap: 10px; font-size: 1.1rem;">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-smile"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 50px; height: 50px; padding: 0; border-radius: 50%; box-shadow: var(--shadow-md);">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Scroll auto vers le bas
    const chatDiv = document.getElementById('chat-messages');
    chatDiv.scrollTop = chatDiv.scrollHeight;

    // Auto-expand textarea (bonus)
    const textarea = document.querySelector('textarea[name="body"]');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        chatDiv.scrollTop = chatDiv.scrollHeight;
    });
</script>
