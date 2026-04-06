<?php
/**
 * seed.php — Seed database with realistic demo data
 */
require_once __DIR__ . '/backend/config/bootstrap.php';

$db = Database::getInstance()->getPdo();

echo "<h1>Initialisation des données de test...</h1>";

try {
    // 1. On vide la table ads avant de remplir
    $db->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $db->exec("TRUNCATE TABLE ads;");
    $db->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // 2. On s'assure d'avoir un utilisateur Admin (ID 1 par défaut dans database.sql)
    $stmt = $db->query("SELECT id FROM users LIMIT 1");
    $user = $stmt->fetch();
    $userId = $user ? $user['id'] : 1;

    // 3. Données réalistes
    $data = [
        [
            'user_id' => $userId,
            'title'   => 'iPhone 13 Noir - Coque MagSafe',
            'type'    => 'lost',
            'category'=> 'Électronique',
            'city'    => 'Lyon (69)',
            'location_details' => 'Oublié sur la table du Starbucks Place Bellecour.',
            'event_date'       => '2026-03-28',
            'description'      => 'iPhone 13 noir en parfait état. Il a une coque en silicone bleu foncé avec un cercle MagSafe au dos. Le fond d\'écran est une photo de montagne.'
        ],
        [
            'user_id' => $userId,
            'title'   => 'Golden Retriever (Max) - Collier Rouge',
            'type'    => 'found',
            'category'=> 'Animaux',
            'city'    => 'Paris (15e)',
            'location_details' => 'Trouvé errant près du Parc André Citroën.',
            'event_date'       => '2026-03-30',
            'description'      => 'Chien très amical, Golden Retriever mâle. Porte un collier en cuir rouge mais pas de plaque d\'identification. Très calme.'
        ],
        [
            'user_id' => $userId,
            'title'   => 'Trousseau de clés - Porte-clé Cuir Bleu',
            'type'    => 'found',
            'category'=> 'Clés',
            'city'    => 'Bordeaux',
            'location_details' => 'Trouvé sur un banc Quai des Marques.',
            'event_date'       => '2026-03-31',
            'description'      => 'Trousseau de 4 clés (2 grosses, 2 petites). Attachées ensemble par un porte-clé en cuir bleu avec une petite clochette en argent.'
        ],
        [
            'user_id' => $userId,
            'title'   => 'Sac à dos Herschel Gris',
            'type'    => 'lost',
            'category'=> 'Sacs',
            'city'    => 'Lille',
            'location_details' => 'Probablement oublié dans la bibliothèque de l\'université.',
            'event_date'       => '2026-03-25',
            'description'      => 'Sac à dos gris avec les sangles en cuir marron. Contient des cours d\'économie et une trousse. Pas de matériel de valeur à l\'intérieur.'
        ],
        [
            'user_id' => $userId,
            'title'   => 'Montre Apple Watch Series 7',
            'type'    => 'found',
            'category'=> 'Électronique',
            'city'    => 'Marseille',
            'location_details' => 'Trouvée dans les vestiaires de la salle de sport.',
            'event_date'       => '2026-03-29',
            'description'      => 'Apple Watch argentée avec un bracelet Sport noir. Elle est verrouillée avec un code.'
        ],
        [
            'user_id' => $userId,
            'title'   => 'Passeport au nom de David Durand',
            'type'    => 'found',
            'category'=> 'Documents',
            'city'    => 'Strasbourg',
            'location_details' => 'Trouvé à l\'aéroport près de la porte B12.',
            'event_date'       => '2026-03-30',
            'description'      => 'Passeport français trouvé dans un étui de protection transparent. Merci de me contacter pour vérification d\'identité.'
        ]
    ];

    $sql = "INSERT INTO ads (user_id, title, type, category, city, location_details, event_date, description) 
            VALUES (:user_id, :title, :type, :category, :city, :location_details, :event_date, :description)";
    $stmt = $db->prepare($sql);

    foreach ($data as $row) {
        $stmt->execute($row);
    }

    echo "<h2 style='color: green;'>Succès ! 6 annonces réalistes ont été ajoutées.</h2>";
    echo "<p><a href='index.php?action=ads'>Cliquez ici pour voir la page Explorer</a></p>";

} catch (Exception $e) {
    echo "<h2 style='color: red;'>Erreur : " . $e->getMessage() . "</h2>";
}
