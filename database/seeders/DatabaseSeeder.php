<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $admin = User::create([
            'name' => 'Jakub',
            'email' => 'hrncir@zondy.cz',
            'password' => bcrypt('Zondy2025!'),
        ]);

        $this->call(EstablishmentSeeder::class);
    }
}
