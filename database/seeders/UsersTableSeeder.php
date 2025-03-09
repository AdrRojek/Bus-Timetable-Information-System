<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['id'=>1,'email'=>'jannowak@email.com','first_name'=>'Jan','last_name'=>'Nowak','password'=>'$2y$12$NHkuo.t5nAZoaceH6EwpE.JNeYdOPR2BauV/sfyTjVrP522dCb0Je','admin'=>1],
            ['id'=>2,'email'=>'john@example.com','first_name'=>'John','last_name'=>'Doe','password'=>'$2y$12$NHkuo.t5nAZoaceH6EwpE.JNeYdOPR2BauV/sfyTjVrP522dCb0Je','admin'=>1],
            ['id'=>3,'email'=>'krzy@email.com','first_name'=>'Krzysztof','last_name'=>'Kazik','password'=>'$2y$12$2/aOXMlkFG/cXGStB0tyZetM5Q70G0OXaFwRi6fJhZ0U5KuuPAAwq','admin'=>0],
            ['id'=>4,'email'=>'p.nowak@email.com','first_name'=>'Piotr','last_name'=>'Nowak','password'=>'$2y$12$ImgqXAcdcyEjNp3Khbi8AOJpo2XHeau4lnnUropOhOmSm1kGy/Fy2','admin'=>0],       
        ]);
    }
}
