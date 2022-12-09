<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypesCombatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_combat')->insert(
            ['type' =>"defense speciale"]
        );

        DB::table('types_combat')->insert(
            ['type' =>"attaque speciale"]
        );

        DB::table('types_combat')->insert(
            ['type' =>"attaque normale"]
        );

    
    }
}
