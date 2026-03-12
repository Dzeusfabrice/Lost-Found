<?php

/**
 * FilterStrategy — Interface du Pattern Strategy (Recherche)
 * Chaque filtre de recherche implémente cette interface.
 * Responsable : P5 — Etaba
 */
interface FilterStrategy
{
    /**
     * Applique le filtre sur les conditions SQL.
     *
     * @param array<string> $conditions Tableau des clauses WHERE (passé par référence)
     * @param array<mixed>  $params     Tableau des paramètres PDO (passé par référence)
     * @param array<mixed>  $input      Données de la requête (GET/POST)
     */
    public function apply(array &$conditions, array &$params, array $input): void;
}
