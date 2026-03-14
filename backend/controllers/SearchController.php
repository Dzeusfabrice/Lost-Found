<?php

/**
 * SearchController — Filtres combinés, pagination
 * Responsable : P5 — Développeur Logique 2
 */
class SearchController
{
    private AdModel $adModel;

    public function __construct()
    {
        $this->adModel = ModelFactory::create('ad');
    }

    public function handle(): void
    {
        $conditions = [];
        $params     = [];
        $input      = $_GET;

        // Application des stratégies de filtrage
        $strategies = [
            new TypeFilter(),
            new CityFilter(),
            new DateFilter(),
            new KeywordFilter(),
        ];

        foreach ($strategies as $strategy) {
            $strategy->apply($conditions, $params, $input);
        }

        $page   = (int)($input['page'] ?? 1);
        $result = $this->adModel->search($conditions, $params, $page);

        $ads        = $result['ads'];
        $total      = $result['total'];
        $filters    = $input;
        $pagination = $result;

        require VIEWS_PATH . '/search/results.php';
    }
}
