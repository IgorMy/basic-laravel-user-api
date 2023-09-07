<?php

use App\Builders\RoleFilterBuilder;

it('check empty builder with only take and skip', function () {

    $builder = new RoleFilterBuilder(
        filters: [
            'take' => 10,
            'skip' => 0
        ]
    );

    $this->assertEquals(
        $builder->getWhere(),
        []
    );

    $this->assertEquals(
        $builder->getSkip(),
        0
    );

    $this->assertEquals(
        $builder->getTake(),
        10
    );

});

