<?php

declare(strict_types=1);


namespace App\Builders;

final readonly class RoleFilterBuilder extends BaseFilterBuilder
{

    /**
     * Also, we conserve the original array of filters for debugging or in case we need to use it later.
     *
     * @param array $filters
     */
    public function __construct(array $filters = []){

        parent::__construct(
            likeFilters: [
                'title'
            ],
            equalFilters: [
                'RoleUlid',
                'base_role'
            ],
            filters: $filters
        );

    }
}
