<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::factory()->create([
            'title' => 'admin',
            'base_role' => true,
        ]);

        Role::factory()->create([
            'title' => 'user',
            'base_role' => true,
        ]);
        

    }
}
