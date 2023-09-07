<?php

use App\Builders\UserFilterBuilder;

it('check empty builder with only take and skip', function () {

    $builder = new UserFilterBuilder(
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

