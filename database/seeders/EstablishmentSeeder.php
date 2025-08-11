<?php

namespace Database\Seeders;

use App\Models\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Establishment::create([
            'name' => 'Kratochvílova',
            'code' => 4143,
            'address' => 'Kratochvílova 30',
            'city' => 'Přerov',
            'postal_code' => '750 02',
            'phone' => null,
            'email' => null,
            'longitude' => '17.4503350',
            'latitude' => '49.4521270',
            'order_column' => 1,
        ]);

        Establishment::create([
            'name' => 'Želatovská',
            'code' => 3081,
        ]);

        Establishment::create([
            'name' => 'Svisle',
            'code' => 3289,
        ]);

        Establishment::create([
            'name' => 'Za Mlýnem',
            'code' => 0114,
        ]);

        Establishment::create([
            'name' => 'Hranická 14',
            'code' => 3220,
        ]);

        Establishment::create([
            'name' => 'Trávník 27',
            'code' => 0353,
            'address' => 'Trávník 165/27',
            'city' => 'Přerov',
            'postal_code' => '750 02',
            'phone' => null,
            'email' => null,
        ]);

        Establishment::create([
            'name' => 'U Tenisu 4',
            'code' => 0512,
            'address' => 'U Tenisu 4',
            'city' => 'Přerov',
            'postal_code' => '750 02',
        ]);

        Establishment::create([
            'name' => 'Kozlovská 44',
            'code' => 3566,
            'address' => 'Kozlovská 44',
            'city' => 'Přerov',
            'postal_code' => '750 02',
            'phone' => null,
            'email' => null,
        ]);

    }
}
