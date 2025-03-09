<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('routes')->insert([
            ['id' => 1, 'name' => 'Rejtana Skrzyżowanie - Pl. Wolności Fontanna', 'description' => 'Rejtana Skrzyżowanie - Lisa Kuli Rondo - Dworzec Główny PKP - Podpromie Kościół - Pl. Wolności Fontanna', 'user_id' => 1],
            ['id' => 2, 'name' => 'Dworzec Główny PKP - Galeria Rzeszów Główne Wejści', 'description' => 'Dworzec Główny PKP - Lisa Kuli Rondo - Kwiatkowskiego Skrzyżowanie - Galeria Rzeszów Główne Wejście', 'user_id' => 2],
            ['id' => 3, 'name' => 'Nowe Miasto Osiedle - Port Lotniczy Rzeszów-Jasion', 'description' => 'Nowe Miasto Osiedle - Uniwersytet Rzeszowski Wydział Prawa - Centrum Wystawienniczo-Kongresowe G2A Arena - Port Lotniczy Rzeszów-Jasionka Terminal', 'user_id' => 3],
            ['id' => 4, 'name' => 'Tyczyn Rynek - Łańcut Zamek', 'description' => 'Tyczyn Rynek - Błażowa Zamek - Łańcut Zamek', 'user_id' => NULL],
            ['id' => 5, 'name' => 'Głogów Małopolski Urząd Miasta - Strzyżów Rynek', 'description' => 'Głogów Małopolski Urząd Miasta - Kolbuszowa Rynek - Ropczyce Rynek - Sędziszów Małopolski Rynek - Strzyżów Rynek', 'user_id' => NULL],
        ]);
    }
}