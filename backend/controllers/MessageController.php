<?php

/**
 * MessageController — Conversations et messages
 * Responsable : P6 — Développeur Logique 3
 */
class MessageController
{
    private MessageModel $messageModel;
    private ConversationModel $conversationModel;
    private AdModel $adModel;

    public function __construct()
    {
        $this->messageModel      = ModelFactory::create('message');
        $this->conversationModel = ModelFactory::create('conversation');
        $this->adModel           = ModelFactory::create('ad');
    }

    public function index(): void
    {
        requireLogin();
        $conversations = $this->conversationModel->findByUser(currentUserId());
        require VIEWS_PATH . '/messages/list.php';
    }

    public function view(): void
    {
        requireLogin();
        $convId = (int)($_GET['id'] ?? 0);
        $userId = currentUserId();

        if (!$this->conversationModel->userBelongs($convId, $userId)) {
            redirect('messages');
        }

        // Marquer comme lus
        $this->messageModel->markAsRead($convId, $userId);

        $messages     = $this->messageModel->findByConversation($convId);
        $conversation = $this->conversationModel->findById($convId);
        $ad           = $this->adModel->findById($adId = (int)$conversation['ad_id']);

        // Identifier l'autre utilisateur pour la vue
        $otherUserId  = ($conversation['user1_id'] == $userId) ? $conversation['user2_id'] : $conversation['user1_id'];
        $userModel    = ModelFactory::create('user');
        $otherUser    = $userModel->findById($otherUserId);

        require VIEWS_PATH . '/messages/view.php';
    }

    public function start(): void
    {
        requireLogin();
        checkCsrf();

        $adId = (int)($_POST['ad_id'] ?? 0);
        $ad   = $this->adModel->findById($adId);

        if (!$ad) redirect('ads');

        $ownerId = (int)$ad['user_id'];
        $myId    = currentUserId();

        if ($ownerId === $myId) redirect('ads.view', ['id' => $adId]);

        // Créer ou récupérer la conversation
        $convId = $this->conversationModel->findOrCreate($adId, $ownerId, $myId);

        // Envoyer le premier message si présent
        if (!empty($_POST['message'])) {
            $this->messageModel->sendMessage($convId, $myId, $_POST['message']);
        }

        redirect('messages.view', ['id' => $convId]);
    }

    public function send(): void
    {
        requireLogin();
        checkCsrf();

        $convId = (int)($_POST['conversation_id'] ?? 0);
        $body   = $_POST['body'] ?? '';

        if ($this->conversationModel->userBelongs($convId, currentUserId()) && !empty(trim($body))) {
            $this->messageModel->sendMessage($convId, currentUserId(), $body);
        }

        redirect('messages.view', ['id' => $convId]);
    }
}
