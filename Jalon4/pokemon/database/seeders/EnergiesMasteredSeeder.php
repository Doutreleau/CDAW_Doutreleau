<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnergiesMasteredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('energy_mastered')->insert(  
            ['id_energy'=>"3", 'id_user' => "1" ]
        );

        DB::table('energy_mastered')->insert(              
            ['id_energy'=>"2", 'id_user' => "2" ]
         );

         
        DB::table('energy_mastered')->insert(             
            ['id_energy'=>"9", 'id_user' => "2" ]
         );

    
    }
}
