<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'user_name' => 'admin',
            'email' => env('ADMIN_EMAIL', 'admin@admin.admin'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'admin')),
            'RoleUlid' => Role::getAdminRoleCached()->RoleUlid
        ]);
    }
}
