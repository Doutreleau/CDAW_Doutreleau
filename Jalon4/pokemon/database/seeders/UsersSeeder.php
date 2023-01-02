<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(  
            ['name' =>"Finn", 'email' => "finn@namee.bio",'password' => "$2y$10$6VCoKjRAgp7EU6PGEOdtTOxQMN3bNLS2V.RGJo32KjTj4jU2o/ilu",'nb_victories' => "1" ]
        );

        DB::table('users')->insert(  
            ['name' =>"Oli", 'email' => "oli@namee.bio",'password' => "$2y$10$.2jBL5Ud6kFmMNDSDPwSIOorvq9s0TtdFPhbz.s.67oETi4cQQsQe",'nb_victories' => "24" ]
        );

    
    }
}
