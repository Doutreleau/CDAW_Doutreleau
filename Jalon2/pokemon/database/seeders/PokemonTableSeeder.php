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

                $pokemonEnergies = array("NULL","NULL");
                $countEnergies = 0;
                //get the energies. I only kept two energies per pokemon
                foreach($pokemonPage->types as $type){
                    foreach($type->type as $energyType){

                        if($energyType[0] != "h"){ //ie : it is not the url
                            $pokemonEnergies[$countEnergies] = $energyType;
                            $countEnergies = $countEnergies + 1;
                        }                
                    }
                }

                //set pv_max to 100, because I can't find any data on pv in PokeApi
                $pokemonPv_max = 100;

                //set level to 0
                $pokemonLevel = 0;
                
                
                DB::table('pokemon_table')->insert([
                    'name' => $pokemonName,
                    'id' => $pokemonId,
                    'energy_1'=> $pokemonEnergies[0],
                    'energy_2'=> $pokemonEnergies[1],
                    'pv_max'=>$pokemonPv_max,
                    'level'=>$pokemonLevel,
                    'path'=>$pokemonImage
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
