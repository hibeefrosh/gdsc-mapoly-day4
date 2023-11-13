<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create headmaster
        User::factory()->create([
            'name' => 'Headmaster',
            'email' => 'headmaster@example.com',
            'password' => bcrypt('password'),
            'role' => 'headmaster',
        ]);

        // Create registrar
        User::factory()->create([
            'name' => 'Registrar',
            'email' => 'registrar@example.com',
            'password' => bcrypt('password'),
            'role' => 'registrar',
        ]);

        
    }
}
