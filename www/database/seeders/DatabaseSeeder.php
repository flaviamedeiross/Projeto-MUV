<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\RolesSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\TripsSeeder;
use Database\Seeders\SugestsSeeder;
use Database\Seeders\ReservsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return voidz
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            TripsSeeder::class, 
            SugestsSeeder::class,
            ReservsSeeder::class,
        ]);
    }
}
