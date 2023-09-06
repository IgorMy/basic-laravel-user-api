<?php

declare(strict_types=1);


namespace App\Builders;

final readonly class UserFilterBuilder extends BaseFilterBuilder
{

    /**
     * Also, we conserve the original array of filters for debugging or in case we need to use it later.
     *
     * @param array $filters
     */
    public function __construct(array $filters = []){
        parent::__construct(
            likeFilters: [
                'user_name',
                'email'
            ],
            equalFilters: [
                'UsersUlid',
                'RoleUlid'
            ],
            filters: $filters
        );
    }

}
