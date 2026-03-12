<?php

/**
 * TypeFilter — Filtre par type (lost / found)
 * Pattern Strategy — Responsable : P5 — Etaba
 */
class TypeFilter implements FilterStrategy
{
    public function apply(array &$conditions, array &$params, array $input): void
    {
        if (!empty($input['type']) && in_array($input['type'], ['lost', 'found'], true)) {
            $conditions[] = 'a.type = ?';
            $params[]     = $input['type'];
        }
    }
}
