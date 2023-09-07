<?php

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

function authAdmin(): TestResponse
{
    return test()->post('/api/auth/login', [
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD')
    ]);
}

function asAdmin(): TestCase
{
    $response = authAdmin()->json();

    $token = $response['access_token'];

    return test()->withHeaders([
        'Authorization' => 'Bearer ' . $token
    ]);
}
