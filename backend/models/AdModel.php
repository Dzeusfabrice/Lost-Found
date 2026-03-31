<?php

/**
 * AdModel — CRUD annonces, filtres, pagination
 * Responsable : P5 — Etaba
 * Métriques cibles : CC <= 10, WMC <= 18
 */
class AdModel
{
    public function __construct(private PDO $pdo) {}

    /** Crée une annonce. */
    public function create(array $data): int
    {
        $sql = 'INSERT INTO ads (user_id, title, type, category, city, location_details, event_date, description, photo_path)
                VALUES (:user_id, :title, :type, :category, :city, :location_details, :event_date, :description, :photo_path)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id'          => $data['user_id'],
            ':title'            => $data['title'],
            ':type'             => $data['type'],
            ':category'         => $data['category'],
            ':city'             => $data['city'],
            ':location_details' => $data['location_details'] ?? null,
            ':event_date'       => $data['event_date'],
            ':description'      => $data['description'],
            ':photo_path'       => $data['photo_path'] ?? null,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /** Retourne une annonce par ID avec les infos de l'auteur. */
    public function findById(int $id): ?array
    {
        $sql = 'SELECT a.*, u.name AS user_name, u.email AS user_email
                FROM ads a
                JOIN users u ON u.id = a.user_id
                WHERE a.id = ? LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Recherche d'annonces avec filtres (Pattern Strategy appliqué en amont par SearchController).
     * @param array<string>  $conditions Clauses WHERE déjà construites
     * @param array<mixed>   $params     Paramètres PDO associés
     * @param int            $page       Page courante (1-based)
     * @param int            $perPage    Annonces par page
     * @return array{ads: array, total: int, page: int, pages: int}
     */
    public function search(array $conditions, array $params, int $page = 1, int $perPage = 12): array
    {
        $where  = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
        $offset = ($page - 1) * $perPage;

        $countSql = "SELECT COUNT(*) FROM ads a $where";
        $stmt     = $this->pdo->prepare($countSql);
        $stmt->execute($params);
        $total = (int) $stmt->fetchColumn();

        $sql  = "SELECT a.*, u.name AS user_name
                 FROM ads a JOIN users u ON u.id = a.user_id
                 $where
                 ORDER BY a.created_at DESC
                 LIMIT $perPage OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return [
            'ads'   => $stmt->fetchAll(),
            'total' => $total,
            'page'  => $page,
            'pages' => (int) ceil($total / $perPage),
        ];
    }

    /** Met à jour une annonce (propriétaire vérifié en contrôleur). */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = [];

        foreach (['title', 'category', 'city', 'location_details', 'event_date', 'description', 'photo_path'] as $field) {
            if (array_key_exists($field, $data)) {
                $fields[]         = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) {
            return false;
        }

        $params[':id'] = $id;
        $stmt = $this->pdo->prepare('UPDATE ads SET ' . implode(', ', $fields) . ' WHERE id = :id');
        return $stmt->execute($params);
    }

    /** Supprime une annonce. */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM ads WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /** Change le statut open -> resolved (sens unique). */
    public function changeStatus(int $id, int $userId): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ads SET status = 'resolved' WHERE id = ? AND user_id = ? AND status = 'open'");
        return $stmt->execute([$id, $userId]) && $stmt->rowCount() > 0;
    }

    /** Annonces d'un utilisateur. */
    public function findByUser(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ads WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /** Toutes les annonces (admin). */
    public function findAll(bool $includeHidden = false): array
    {
        $sql  = 'SELECT a.*, u.name AS user_name FROM ads a JOIN users u ON u.id = a.user_id ORDER BY a.created_at DESC';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    /** Masque / démasque une annonce (admin). */
    public function setHidden(int $id, bool $hidden): bool
    {
        $stmt = $this->pdo->prepare('UPDATE ads SET is_hidden = ? WHERE id = ?');
        return $stmt->execute([(int) $hidden, $id]);
    }

    /** Statistiques globales pour le dashboard admin. */
    public function getStats(): array
    {
        $row = $this->pdo->query(
            "SELECT
                COUNT(*) AS total_ads,
                SUM(type = 'lost') AS total_lost,
                SUM(type = 'found') AS total_found,
                SUM(status = 'open') AS open_count,
                SUM(status = 'resolved') AS total_resolved
             FROM ads"
        )->fetch();
        return $row ?: [];
    }
}
