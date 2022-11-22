<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //fetches the caracteristics of Pokemons from the API
        //those caracteristics are : id, energy, name, pv_max, level, image path
        $page = file_get_contents('https://pokeapi.co/api/v2/pokemon/');
        $page = json_decode($page);
        foreach($page->results as $pokemon){

            //get the name
            $pokemonName = $pokemon->name;

            //get the id of each pokemon
            $url = $pokemon->url;
            $values = parse_url($url);
            $pokemonId = explode('/',$values['path'])[4]; //the id of the pokemon is in the url, so we explore the url to get the id
            
            //gets the image ("sprite") of the pokemon
            $basePokemonPage = 'https://pokeapi.co/api/v2/pokemon/';
            $pokemonPageUrl = $basePokemonPage.$pokemonId;
            $pokemonPage = file_get_contents($pokemonPageUrl); //gets the content of the url page of the pokemon
            $pokemonPage = json_decode($pokemonPage);
            $pokemonImage = $pokemonPage->sprites->front_default;

            //get the energy
            //I kept only 1 energy type per pokemon (but I guess I could create another column in the table to store the second energy type when needed?)
            foreach($pokemonPage->types as $type){
                foreach($type->type as $energyType){

                    if($energyType[0] != "h"){ //ie : it is not the url
                        $pokemonEnergy = $energyType;
                    }                
                }
            }

            //set pv_max to 100, because I can't find any data on pv in PokeApi
            $pokemonPv_max = 100;

            //set level to 0
            $pokemonLevel = 0;

            DB::table('pokemon')->insert([
                'name' => $pokemonName,
                'id' => $pokemonId,
                'energy'=> $pokemonEnergy,
                'pv_max'=>$pokemonPv_max,
                'level'=>$pokemonLevel,
                'path'=>$pokemonImage
               ]);
    
        }
    }
}