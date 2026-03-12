<?php

/**
 * KeywordFilter — Filtre par mot-clé (titre + description)
 * Pattern Strategy — Responsable : P5 — Etaba
 */
class KeywordFilter implements FilterStrategy
{
    public function apply(array &$conditions, array &$params, array $input): void
    {
        if (!empty($input['q'])) {
            $keyword      = '%' . trim($input['q']) . '%';
            $conditions[] = '(a.title LIKE ? OR a.description LIKE ?)';
            $params[]     = $keyword;
            $params[]     = $keyword;
        }
    }
}
