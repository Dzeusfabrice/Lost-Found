<?php

/**
 * ModelFactory — Pattern Factory
 * Centralise la création des objets Modèle.
 * Responsable : P6 — Noumi
 */
class ModelFactory
{
    public static function create(string $type): object
    {
        $pdo = Database::getInstance()->getPdo();

        return match ($type) {
            'user'         => new UserModel($pdo),
            'ad'           => new AdModel($pdo),
            'conversation' => new ConversationModel($pdo),
            'message'      => new MessageModel($pdo),
            default        => throw new InvalidArgumentException('Modèle inconnu : ' . $type),
        };
    }
}
