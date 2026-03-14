<?php
$pageTitle = "Discussion";
require VIEWS_PATH . '/layouts/header.php';
?>

<div style="display: flex; flex-direction: column; height: calc(100vh - 200px);">
    
    <!-- En-tête de la conversation -->
    <div style="background: white; border-bottom: 1px solid #e2e8f0; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; border-radius: var(--radius) var(--radius) 0 0;">
        <a href="<?= BASE_URL ?>/index.php?action=messages" style="color: var(--text-muted);"><i class="fas fa-arrow-left"></i></a>
        <div style="flex: 1;">
            <h3 style="margin:0; font-size: 1.1rem;"><?= e($ad['title']) ?></h3>
            <p style="margin:0; font-size: 0.8rem; color: var(--text-muted);">Discussion avec le propriétaire</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
            Voir l'annonce
        </a>
    </div>

    <!-- Fil de messages -->
    <div id="chat-box" style="flex: 1; overflow-y: auto; padding: 1.5rem; background: #f8fafc; display: flex; flex-direction: column; gap: 1rem;">
        <?php foreach ($messages as $msg): 
            $isMine = ($msg['sender_id'] == $_SESSION['user_id']);
        ?>
            <div style="display: flex; flex-direction: column; align-items: <?= $isMine ? 'flex-end' : 'flex-start' ?>;">
                <div style="max-width: 70%; padding: 0.75rem 1rem; border-radius: 18px; position: relative;
                    background: <?= $isMine ? 'var(--primary)' : 'white' ?>; 
                    color: <?= $isMine ? 'white' : 'var(--text-main)' ?>;
                    box-shadow: var(--shadow-sm);
                    border-bottom-<?= $isMine ? 'right' : 'left' ?>-radius: 4px;">
                    <?= nl2br(e($msg['body'])) ?>
                </div>
                <span style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px; padding: 0 4px;">
                    <?= date('H:i', strtotime($msg['created_at'])) ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Formulaire de réponse -->
    <div style="background: white; padding: 1rem 1.5rem; border-top: 1px solid #e2e8f0; border-radius: 0 0 var(--radius) var(--radius);">
        <form action="<?= BASE_URL ?>/index.php?action=messages.send" method="POST" style="display: flex; gap: 1rem;">
            <?= csrfField() ?>
            <input type="hidden" name="conversation_id" value="<?= $conversation['id'] ?>">
            <textarea name="body" placeholder="Votre message..." required 
                style="flex: 1; border: 1px solid #e2e8f0; border-radius: 20px; padding: 0.75rem 1.25rem; font-family: inherit; resize: none; height: 45px; outline: none; transition: var(--transition);"></textarea>
            <button type="submit" class="btn btn-primary" style="width: 45px; height: 45px; border-radius: 50%; padding: 0;">
                <i class="fas fa-paper-plane" style="margin: 0;"></i>
            </button>
        </form>
    </div>

</div>

<script>
    // Scroller vers le bas automatiquement
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>
