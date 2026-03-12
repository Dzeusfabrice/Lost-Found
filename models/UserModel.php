<?php

/**
 * UserModel — CRUD utilisateurs, validation, authentification
 * Responsable : P4 — Développeur Logique 1
 * Métriques cibles : CC <= 8, WMC <= 15
 */
class UserModel
{
    public function __construct(private PDO $pdo) {}

    /**
     * Crée un nouvel utilisateur.
     * @param array<string, string> $data
     * @throws PDOException si l'email existe déjà
     */
    public function create(array $data): int
    {
        $sql = 'INSERT INTO users (name, email, password_hash, phone)
                VALUES (:name, :email, :password_hash, :phone)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name'          => $data['name'],
            ':email'         => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            ':phone'         => $data['phone'] ?? null,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /** Recherche un utilisateur par email. */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Recherche un utilisateur par ID. */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Vérifie le mot de passe. */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Met à jour les informations d'un utilisateur.
     * @param array<string, string> $data
     */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = [];

        if (isset($data['name'])) {
            $fields[] = 'name = :name';
            $params[':name'] = $data['name'];
        }
        if (isset($data['phone'])) {
            $fields[] = 'phone = :phone';
            $params[':phone'] = $data['phone'];
        }
        if (isset($data['password'])) {
            $fields[] = 'password_hash = :password_hash';
            $params[':password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        }

        if (empty($fields)) {
            return false;
        }

        $params[':id'] = $id;
        $sql  = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /** Retourne tous les utilisateurs (pour l'admin). */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, name, email, phone, role, is_active, created_at FROM users ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    /** Active ou suspend un compte. */
    public function setActive(int $id, bool $active): bool
    {
        $stmt = $this->pdo->prepare('UPDATE users SET is_active = ? WHERE id = ?');
        return $stmt->execute([(int) $active, $id]);
    }

    /** Supprime un utilisateur. */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
