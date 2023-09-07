<?php

it('login', function () {
    authAdmin()->assertStatus(200);
});

it('logout', function () {
    asAdmin()->get('/api/auth/logout')->assertStatus(200);
});

it('refresh', function () {
    asAdmin()->get('/api/auth/refresh')->assertStatus(200);
});

it('me', function () {
    asAdmin()->get('/api/auth/me')->assertStatus(200);
});
