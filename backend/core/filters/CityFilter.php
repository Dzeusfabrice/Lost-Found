<?php

/**
 * CityFilter — Filtre par ville
 * Pattern Strategy — Responsable : P5 — Etaba
 */
class CityFilter implements FilterStrategy
{
    public function apply(array &$conditions, array &$params, array $input): void
    {
        if (!empty($input['city'])) {
            $conditions[] = 'a.city LIKE ?';
            $params[]     = '%' . trim($input['city']) . '%';
        }
    }
}
