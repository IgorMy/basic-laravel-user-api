<?php

use App\Models\Role;
use App\Models\User;

it('get users', function () {
    $response = asAdmin()->get('/api/user');
    $response->assertStatus(200);
});

it('create user', function () {

    $response = asAdmin()->post('/api/user', [
        'user_name' => 'test',
        'email' => 'test@test.test',
        'password' => '12345678',
        'RoleUlid' => Role::getUserRoleCached()->RoleUlid
    ]);

    if($response->status() == 201){
        User::where('email', 'test@test.test')->delete();
    }

    $response->assertStatus(201);
});

it('update user', function () {

    $user = User::factory()->create();

    $response = asAdmin()->patch('/api/user/' . $user->UsersUlid, [
        'user_name' => 'test'
    ]);

    $user->delete();

    $response->assertStatus(200);

});

it('delete user', function () {

    $user = User::factory()->create();

    $response = asAdmin()->delete('/api/user/' . $user->UsersUlid);

    $user->delete();

    $response->assertStatus(200);

});

it('search user', function () {
    asAdmin()->post('/api/user/search',['take'=>10,'skip'=>0])
        ->assertStatus(200);
});
