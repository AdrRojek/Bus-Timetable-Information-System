<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteDatesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('route_dates')->insert([
            ['id' => 1, 'route_id' => 1, 'date' => '2024-06-07'],
            ['id' => 2, 'route_id' => 2, 'date' => '2024-06-07'],
            ['id' => 3, 'route_id' => 2, 'date' => '2024-06-08'],
            ['id' => 4, 'route_id' => 1, 'date' => '2024-06-12'],
            ['id' => 5, 'route_id' => 1, 'date' => '2024-06-21'],
            ['id' => 6, 'route_id' => 1, 'date' => '2024-06-20'],
            ['id' => 7, 'route_id' => 3, 'date' => '2024-06-07'],
            ['id' => 8, 'route_id' => 3, 'date' => '2024-06-08'],
            ['id' => 9, 'route_id' => 3, 'date' => '2024-06-13'],
            ['id' => 10, 'route_id' => 3, 'date' => '2024-06-09'],
        ]);
    }
    
}
