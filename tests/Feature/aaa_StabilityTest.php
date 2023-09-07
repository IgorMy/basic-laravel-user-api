<?php

test('public get routes', function ($url) {
    $this->get($url)->assertOk();
})->with('public routes');
