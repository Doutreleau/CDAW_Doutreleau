<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        function showPokemonsOfOnePage($page,$listEnergies){
            $page = json_decode($page);
            foreach($page->results as $pokemon){

               

                //get the id of each pokemon
                $url = $pokemon->url;
                $values = parse_url($url);
                $pokemonId = explode('/',$values['path'])[4];

                 
                //gets the image ("sprite") of the pokemon
                $basePokemonPage = 'https://pokeapi.co/api/v2/pokemon/';
                $pokemonPageUrl = $basePokemonPage.$pokemonId;
                $pokemonPage = file_get_contents($pokemonPageUrl); //gets the content of the url page of the pokemon
                $pokemonPage = json_decode($pokemonPage);

                //get the energies. I only kept two energies per pokemon
                foreach($pokemonPage->types as $type){
                    foreach($type->type as $energyType){

                        if($energyType[0] != "h"){ //ie : it is not the url
                            $pokemonEnergy = $energyType;
                        }
                    }
                }

                if(!in_array($pokemonEnergy, $listEnergies)){
                    array_push($listEnergies,$pokemonEnergy);
                    DB::table('energy')->insert([
                        'name' => $pokemonEnergy,
                        'id' => count($listEnergies)
                        ]);
                }
            }
            return $listEnergies;
        }

        $listEnergies = array();
        //get the Pokemons of the first page
        $page = file_get_contents('https://pokeapi.co/api/v2/pokemon/');
        $listEnergies = showPokemonsOfOnePage($page,$listEnergies);

        //get the Pokemons of the next pages (the number of them is $num_of_pages_to_cover)
        $num_of_pages_to_cover = 20;
        for ($num_of_pages = 1; $num_of_pages<$num_of_pages_to_cover; $num_of_pages++){
            $num_of_offset = $num_of_pages * 20;
            $urlPage = 'https://pokeapi.co/api/v2/pokemon/'.'?offset='.$num_of_offset.'&limit=20';
            $page = file_get_contents($urlPage);
            $listEnergies = showPokemonsOfOnePage($page,$listEnergies);
        }
    
    }
}
