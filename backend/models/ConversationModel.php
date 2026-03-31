<?php

/**
 * ConversationModel — Gestion des conversations
 * Responsable : P6 — Noumi
 * Métriques cibles : CC <= 8
 */
class ConversationModel
{
    public function __construct(private PDO $pdo) {}

    /**
     * Crée une conversation ou retourne l'existante (unicité garantie par UNIQUE KEY).
     */
    public function findOrCreate(int $adId, int $user1Id, int $user2Id): int
    {
        $existing = $this->findByAdAndUsers($adId, $user1Id, $user2Id);
        if ($existing !== null) {
            return $existing['id'];
        }

        $stmt = $this->pdo->prepare(
            'INSERT INTO conversations (ad_id, user1_id, user2_id) VALUES (?, ?, ?)'
        );
        $stmt->execute([$adId, $user1Id, $user2Id]);
        return (int) $this->pdo->lastInsertId();
    }

    /** Cherche une conversation spécifique. */
    public function findByAdAndUsers(int $adId, int $user1Id, int $user2Id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM conversations WHERE ad_id = ? AND user1_id = ? AND user2_id = ? LIMIT 1'
        );
        $stmt->execute([$adId, $user1Id, $user2Id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Retourne une conversation par ID. */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM conversations WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Toutes les conversations d'un utilisateur avec dernier message. */
    public function findByUser(int $userId): array
    {
        $sql = "SELECT c.*,
                       a.title AS ad_title,
                       CASE 
                           WHEN c.user1_id = ? THEN u2.name 
                           ELSE u1.name 
                       END AS other_user_name,
                       (SELECT body FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message_text,
                       (SELECT created_at FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message_date,
                       (SELECT COUNT(*) FROM messages WHERE conversation_id = c.id AND sender_id != ? AND is_read = 0) AS unread_count
                FROM conversations c
                JOIN ads a ON a.id = c.ad_id
                JOIN users u1 ON u1.id = c.user1_id
                JOIN users u2 ON u2.id = c.user2_id
                WHERE c.user1_id = ? OR c.user2_id = ?
                ORDER BY last_message_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $userId, $userId, $userId]);
        return $stmt->fetchAll();
    }

    /** Vérifie qu'un utilisateur fait partie de la conversation. */
    public function userBelongs(int $conversationId, int $userId): bool
    {
        $stmt = $this->pdo->prepare(
            'SELECT 1 FROM conversations WHERE id = ? AND (user1_id = ? OR user2_id = ?) LIMIT 1'
        );
        $stmt->execute([$conversationId, $userId, $userId]);
        return (bool) $stmt->fetchColumn();
    }
}
