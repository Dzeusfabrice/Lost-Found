<?php

/**
 * MessageModel — CRUD messages, marquage lu, comptage non lus
 * Responsable : P6 — Noumi
 * Métriques cibles : CC <= 6
 */
class MessageModel
{
    public function __construct(private PDO $pdo) {}

    /** Envoie un message dans une conversation. */
    public function sendMessage(int $conversationId, int $senderId, string $body): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO messages (conversation_id, sender_id, body) VALUES (?, ?, ?)'
        );
        $stmt->execute([$conversationId, $senderId, trim($body)]);
        return (int) $this->pdo->lastInsertId();
    }

    /** Retourne tous les messages d'une conversation avec les noms d'expéditeurs. */
    public function findByConversation(int $conversationId): array
    {
        $sql = 'SELECT m.*, u.name AS sender_name
                FROM messages m
                JOIN users u ON u.id = m.sender_id
                WHERE m.conversation_id = ?
                ORDER BY m.created_at ASC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$conversationId]);
        return $stmt->fetchAll();
    }

    /** Marque comme lus tous les messages reçus (pas envoyés par userId). */
    public function markAsRead(int $conversationId, int $userId): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE messages SET is_read = 1 WHERE conversation_id = ? AND sender_id != ? AND is_read = 0'
        );
        return $stmt->execute([$conversationId, $userId]);
    }

    /** Compte les messages non lus pour un utilisateur. */
    public function getUnreadCount(int $userId): int
    {
        $sql = 'SELECT COUNT(*) FROM messages m
                JOIN conversations c ON c.id = m.conversation_id
                WHERE m.is_read = 0 AND m.sender_id != ?
                  AND (c.user1_id = ? OR c.user2_id = ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $userId, $userId]);
        return (int) $stmt->fetchColumn();
    }
}
