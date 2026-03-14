<?php

/**
 * UploadService — Validation et stockage sécurisé des images
 * Responsable : P5 — Etaba
 * Métriques cibles : CC <= 7
 */
class UploadService
{
    private const MAX_SIZE = 5 * 1024 * 1024; // 5 Mo
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];
    private const ALLOWED_MIME = ['image/jpeg', 'image/png', 'image/webp'];

    /**
     * Valide et stocke une image uploadée.
     * @param array $file Élément de $_FILES
     * @return string|null Le chemin relatif du fichier stocké ou null en cas d'échec
     */
    public function store(array $file): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // 1. Validation de la taille
        if ($file['size'] > self::MAX_SIZE) {
            return null;
        }

        // 2. Validation de l'extension
        $info      = pathinfo($file['name']);
        $extension = strtolower($info['extension'] ?? '');
        if (!in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            return null;
        }

        // 3. Validation du type MIME réel
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        if (!in_array($mimeType, self::ALLOWED_MIME, true)) {
            return null;
        }

        // 4. Génération d'un nom unique (uniqid) pour éviter les collisions et injections
        $newName  = uniqid('img_', true) . '.' . $extension;
        $target   = UPLOADS_PATH . '/' . $newName;

        // Créer le dossier s'il n'existe pas
        if (!is_dir(UPLOADS_PATH)) {
            mkdir(UPLOADS_PATH, 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $newName;
        }

        return null;
    }
}
