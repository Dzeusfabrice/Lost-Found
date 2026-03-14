<?php

/**
 * DateFilter — Filtre par date d'événement
 * Pattern Strategy — Responsable : P5 — Etaba
 */
class DateFilter implements FilterStrategy
{
    public function apply(array &$conditions, array &$params, array $input): void
    {
        if (!empty($input['date_from'])) {
            $conditions[] = 'a.event_date >= ?';
            $params[]     = $input['date_from'];
        }
        if (!empty($input['date_to'])) {
            $conditions[] = 'a.event_date <= ?';
            $params[]     = $input['date_to'];
        }
    }
}
