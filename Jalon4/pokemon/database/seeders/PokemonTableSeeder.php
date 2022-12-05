<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PokemonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $p = DB::table("energy")->get(["id", "name"])->where("name","=","bug");
        foreach ($p as $item) {
            echo $item->id;
            echo '            ';
        }
        */
        function showPokemonsOfOnePage($page){
            $page = json_decode($page);
            foreach($page->results as $pokemon){

                //get the name
                $pokemonName = $pokemon->name;

                //get the id of each pokemon
                $url = $pokemon->url;
                $values = parse_url($url);
                $pokemonId = explode('/',$values['path'])[4];

                //gets the image ("sprite") of the pokemon
                $basePokemonPage = 'https://pokeapi.co/api/v2/pokemon/';
                $pokemonPageUrl = $basePokemonPage.$pokemonId;
                $pokemonPage = file_get_contents($pokemonPageUrl); //gets the content of the url page of the pokemon
                $pokemonPage = json_decode($pokemonPage);
                $pokemonImage = $pokemonPage->sprites->front_default;

                //get the stats (pv and scores of defense and attacks)
                $pokemonStats = $pokemonPage->stats;
                $pokemonPv = $pokemonStats[0]->base_stat;                
                $pokemonAttackNormal = $pokemonStats[1]->base_stat;
                $pokemonAttackSpecial = $pokemonStats[3]->base_stat;
                $pokemonDefenseSpecial = $pokemonStats[4]->base_stat;

                //get the energies. I only kept two energies per pokemon
                foreach($pokemonPage->types as $type){
                    foreach($type->type as $energyType){

                        if($energyType[0] != "h"){ //ie : it is not the url
                            $pokemonEnergy = $energyType;
                            $energiesFromTable = DB::table("energy")->get(["id", "name"])->where("name","=",$pokemonEnergy);
                            foreach($energiesFromTable as $energyFromTable){
                                $pokemonEnergy = $energyFromTable->id;
                            }
                        }                 
                    }
                }
                //set level to 0
                $pokemonLevel = rand(1,10);          
                
                DB::table('pokemon_table')->insert([
                    'name' => $pokemonName,
                    'id' => $pokemonId,
                    'energy'=> $pokemonEnergy,
                    'pv_max'=>$pokemonPv,
                    'level'=>$pokemonLevel,
                    'path'=>$pokemonImage,
                    'scoreNormalAttack'=>$pokemonAttackNormal,
                    'scoreSpecialAttack'=>$pokemonAttackSpecial,
                    'scoreSpecialDefense'=>$pokemonDefenseSpecial
                    ]);
            }
        }
        //get the Pokemons of the first page
        $page = file_get_contents('https://pokeapi.co/api/v2/pokemon/');
        showPokemonsOfOnePage($page);

        //get the Pokemons of the next pages (the number of them is $num_of_pages_to_cover)
        $num_of_pages_to_cover = 20;
        for ($num_of_pages = 1; $num_of_pages<$num_of_pages_to_cover; $num_of_pages++){
            $num_of_offset = $num_of_pages * 20;
            $urlPage = 'https://pokeapi.co/api/v2/pokemon/'.'?offset='.$num_of_offset.'&limit=20';
            $page = file_get_contents($urlPage);
            showPokemonsOfOnePage($page);
        }
    
    }
}
