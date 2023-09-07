<?php

use App\Models\Role;

it('get roles', function () {
    asAdmin()->get('/api/role')
        ->assertStatus(200);
});

it('get role', function () {
    asAdmin()->get('/api/role/' . Role::where('title', 'admin')->first()->RoleUlid)
        ->assertStatus(200);
});

it('create role', function () {
    $response = asAdmin()->post('/api/role', [
        'title' => 'test',
    ]);

    if($response->status() == 201){
        Role::where('title', 'test')->delete();
    }

    $response->assertStatus(201);
});

it('edit role', function () {

    $newRole = Role::factory()->create();

    $response = asAdmin()->patch('/api/role/' . $newRole->RoleUlid, [
        'title' => 'test',
    ]);

    $newRole->delete();

    $response->assertStatus(200);
});

it('delete role', function () {

    $newRole = Role::factory()->create();

    $response = asAdmin()->delete('/api/role/' . $newRole->RoleUlid);

    # To avoid test register in database if test fail
    $newRole->delete();

    $response->assertStatus(200);
});


