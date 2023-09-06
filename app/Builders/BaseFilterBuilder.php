<?php

declare(strict_types=1);


namespace App\Builders;

abstract readonly class BaseFilterBuilder
{

    protected array $whereClauses;


    public function __construct(
        protected array $likeFilters = [],
        protected array $equalFilters = [],
        protected array $filters = []
    ){
        $filtersProcessed = [];

        foreach ($filters as $key => $value) {

            if(in_array($key, $this->likeFilters)){
                $filtersProcessed[] = $this->processLikeFilter($key, $value);
                continue;
            }

            if(in_array($key, $this->equalFilters)){
                $filtersProcessed[] = $this->processEqualFilter($key, $value);
                continue;
            }

        }

        $this->whereClauses = $filtersProcessed;
    }

    protected function processEqualFilter(string $key, string $value):array
    {
        return [
            $key,
            '=',
            $value
        ];
    }

    protected function processLikeFilter(string $key, string $value):array
    {
        return [
            $key,
            'like',
            "%{$value}%"
        ];
    }

    public function getSkip(): int
    {
        return intval($this->filters['skip']) ?? 0;
    }

    public function getTake(): int
    {
        return intval($this->filters['take']) ?? 10;
    }

    public function getWhere(): array
    {
        return $this->whereClauses;
    }
}
