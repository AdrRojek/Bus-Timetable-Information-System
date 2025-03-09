<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StopsTableSeeder::class,
            UsersTableSeeder::class,
            RoutesTableSeeder::class,
            StopTimesTableSeeder::class,
            RouteDatesTableSeeder::class,
        ]);
    }
}
