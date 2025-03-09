<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopTimesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stop_times')->insert([
['id'=>1,'route_id'=>1,'stop_id'=>1,'arrival_time'=>'13:27:00','departure_time'=>'13:28:00'],
['id'=>2,'route_id'=>1,'stop_id'=>2,'arrival_time'=>'13:33:00','departure_time'=>'13:34:00'],
['id'=>3,'route_id'=>1,'stop_id'=>3,'arrival_time'=>'13:56:00','departure_time'=>'13:57:00'],
['id'=>4,'route_id'=>1,'stop_id'=>4,'arrival_time'=>'14:02:00','departure_time'=>'14:03:00'],
['id'=>5,'route_id'=>1,'stop_id'=>5,'arrival_time'=>'14:36:00','departure_time'=>'14:37:00'],
['id'=>6,'route_id'=>5,'stop_id'=>21,'arrival_time'=>'11:10:00','departure_time'=>'11:11:00'],
['id'=>7,'route_id'=>5,'stop_id'=>22,'arrival_time'=>'13:20:00','departure_time'=>'13:21:00'],
['id'=>8,'route_id'=>5,'stop_id'=>23,'arrival_time'=>'15:23:00','departure_time'=>'15:24:00'],
['id'=>9,'route_id'=>5,'stop_id'=>24,'arrival_time'=>'16:56:00','departure_time'=>'16:57:00'],
['id'=>10,'route_id'=>5,'stop_id'=>25,'arrival_time'=>'21:44:00','departure_time'=>'21:45:00'],
['id'=>11,'route_id'=>4,'stop_id'=>16,'arrival_time'=>'13:23:00','departure_time'=>'13:24:00'],
['id'=>12,'route_id'=>4,'stop_id'=>17,'arrival_time'=>'15:15:00','departure_time'=>'15:16:00'],
['id'=>13,'route_id'=>4,'stop_id'=>18,'arrival_time'=>'16:23:00','departure_time'=>'16:24:00'],
['id'=>14,'route_id'=>3,'stop_id'=>10,'arrival_time'=>'11:03:00','departure_time'=>'11:04:00'],
['id'=>15,'route_id'=>3,'stop_id'=>13,'arrival_time'=>'12:05:00','departure_time'=>'12:06:00'],
['id'=>16,'route_id'=>3,'stop_id'=>14,'arrival_time'=>'14:33:00','departure_time'=>'14:34:00'],
['id'=>17,'route_id'=>3,'stop_id'=>15,'arrival_time'=>'15:00:00','departure_time'=>'15:01:00'],
['id'=>18,'route_id'=>2,'stop_id'=>8,'arrival_time'=>'16:55:00','departure_time'=>'16:56:00'],
['id'=>19,'route_id'=>2,'stop_id'=>11,'arrival_time'=>'14:54:00','departure_time'=>'14:55:00'],
        ]);
    }
}
