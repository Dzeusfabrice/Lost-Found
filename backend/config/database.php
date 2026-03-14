<?php

/**
 * Configuration de la base de données
 * Responsable : P6 — Noumi
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'lostfound');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET);
