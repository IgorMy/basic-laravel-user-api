<?php

declare(strict_types=1);


namespace App\Builders;

final readonly class UserFilterBuilder
{

    private array $whereClauses;

    private array $likeFilters;

    private array $equalFilters;

    /**
     * Also, we conserve the original array of filters for debugging or in case we need to use it later.
     *
     * @param array $filters
     */
    public function __construct(private array $filters = []){

        $this->likeFilters = [
            'user_name',
            'email'
        ];

        $this->equalFilters = [
            'UsersUlid',
            'RoleUlid'
        ];

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

    private function processEqualFilter(string $key, string $value):array
    {
        return [
            $key,
            '=',
            $value
        ];
    }

    private function processLikeFilter(string $key, string $value):array
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
