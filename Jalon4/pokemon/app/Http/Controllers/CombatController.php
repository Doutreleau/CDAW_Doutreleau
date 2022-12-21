<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Energy;
use Illuminate\Support\Facades\DB;

class CombatController extends Controller
{
    public function choiceSecondUser(){
        return view("/combat/choiceSecondUser");
    }

    /*  
    Checks if the second user exists and has entered the right password.
    If it is the case, it redirects to the page to choose pokemons.
    */
    public function loginSecondUser(Request $request){
        $mailUser2 = $request ->email;
        $users = DB::table('users')->get()->where("email","=",$mailUser2);

        $correctPassword = false;
        foreach($users as $user){
            if (password_verify($request->password, $user->password)) {
                $correctPassword = true;

                //randomly choose which player is the first one
                //by convention, in the database, id_user1 always represents the player who will play first
                $randomFirstPlayer = random_int(1,2);
                if($randomFirstPlayer==1){
                    $idUser1 = auth()->user()->id;
                    $idUser2 = $user->id;
                }
                else{
                    $idUser2 = auth()->user()->id;
                    $idUser1 = $user->id;
                }
                
                $mode = $request -> mode;
                DB::table('combat')->insert([
                    'mode'=> $mode,
                    'id_user1'=>$idUser1,
                    'id_user2'=>$idUser2         
                ]);


                //creation of the 'participe' instance, which will be completed later
                $id_combat = DB::table('combat')->get(['id'])->max('id');
                DB::table('participe')->insert([
                    'id_combat' => $id_combat,
                    'id_pokemon11' => 0,
                    'id_pokemon12' => 0,
                    'id_pokemon13' => 0,
                    'id_pokemon21' => 0,
                    'id_pokemon22' => 0,
                    'id_pokemon23' => 0,
                ]);

                //get the variables needed to render the page of choice of a pokemon (ie the energies and name of the first player)
                $pokemons = DB::table('pokemon_table')->get();
                $max_id = DB::table("combat")->get(["id"])->max('id');
                
                $idUser1s = DB::table("combat")->where("id","=",$max_id)->get(["id_user1"]);
                foreach ($idUser1s as $id1){
                    $id=$id1->id_user1;
                }
                $listEnergiesUser1 = array();
                $energiesUser1 = DB::table("energy_mastered")->where("id_user","=",$id)->get(["id_energy"]);
                foreach($energiesUser1 as $energyUser1){
                    $energiesUser1Name = DB::table("energy")->where("id","=",$energyUser1->id_energy)->get(["name"]);
                    foreach ($energiesUser1Name as $energyUser1Name){
                        array_push($listEnergiesUser1,$energyUser1Name->name);
                    }
                }
                $user1Names = DB::table("users")->where("id","=",$idUser1)->get(["name"]);
                foreach($user1Names as $user1Name){
                    $user1 = $user1Name->name;
                }                
                return view('/combat/choicePokemonUser1', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser1,'user1Name'=>$user1]);
            }                
        }
        if (!$correctPassword){
            echo '<script>alert("The password is incorrect, or the account does not exist")</script>';
            return view('/combat/choiceSecondUser');
        }
    }

    /*
    This function updates the 'participe' table with the chosen pokemon, and redirects to the choice of the next pokemon.
    If the chosen pokemon is invalid (the user made a typo), the page is reloaded.
    */
    public function choicePokemonUser2(Request $request){
        $selectedPokemon = DB::table('pokemon_table')->where("name","=",$request->pokemonName)->get(['name']);
        foreach($selectedPokemon as $pokemon){
            
            $pokemonId = DB::table('pokemon_table')->where("name","=",$pokemon->name)->get(['id']);            
            $max_id = DB::table("combat")->get(["id"])->max('id');
            
            foreach($pokemonId as $id){

                $idsPokemon11 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon11']);
                foreach($idsPokemon11 as $idPoke11){
                    $idPokemon11 = $idPoke11->id_pokemon11;
                      
                }
                $idsPokemon12 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon12']);
                foreach($idsPokemon12 as $idPoke12){
                    $idPokemon12 = $idPoke12->id_pokemon12;
                }
                $idsPokemon13 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon13']);
                foreach($idsPokemon13 as $idPoke13){
                    $idPokemon13 = $idPoke13->id_pokemon13;
                }

                if($idPokemon11==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon11"=>$id->id]);
                }         
                else if($idPokemon12==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon12"=>$id->id]);
                }   
                else if($idPokemon13==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon13"=>$id->id]);
                }   
            }
            
            //get the variables needed to render the page of choice of a pokemon (ie the energies and name of the first player)
            $pokemons = DB::table('pokemon_table')->get();
            $max_id = DB::table("combat")->get(["id"])->max('id');
            $idUser2s = DB::table("combat")->where("id","=",$max_id)->get(["id_user2"]);
            foreach ($idUser2s as $id2){
                $id=$id2->id_user2;
            }
            $listEnergiesUser2 = array();
            $energiesUser2 = DB::table("energy_mastered")->where("id_user","=",$id)->get(["id_energy"]);
            foreach($energiesUser2 as $energyUser2){
                $energiesUser2Name = DB::table("energy")->where("id","=",$energyUser2->id_energy)->get(["name"]);
                foreach ($energiesUser2Name as $energyUser2Name){
                    array_push($listEnergiesUser2,$energyUser2Name->name);
                }
            }
            $user2Names = DB::table("users")->where("id","=",$id)->get(["name"]);
            foreach($user2Names as $user2Name){
                $user2 = $user2Name->name;
            }                
            return view('/combat/choicePokemonUser2', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser2,'user1Name'=>$user2]);
        }  
        
        //in case the pokemon wasn't found (it the user made a typo), the page is reloaded.
        echo "the name of the pokemon is not correct";
        $pokemons = DB::table('pokemon_table')->get();
        $max_id = DB::table("combat")->get(["id"])->max('id');
        $idUser1s = DB::table("combat")->where("id","=",$max_id)->get(["id_user1"]);
        foreach ($idUser1s as $id1){
            $id=$id1->id_user1;
        }
        $listEnergiesUser1 = array();
        $energiesUser1 = DB::table("energy_mastered")->where("id_user","=",$id)->get(["id_energy"]);
        foreach($energiesUser1 as $energyUser1){
            $energiesUser1Name = DB::table("energy")->where("id","=",$energyUser1->id_energy)->get(["name"]);
            foreach ($energiesUser1Name as $energyUser1Name){
                array_push($listEnergiesUser1,$energyUser1Name->name);
            }
        }
        $user1Names = DB::table("users")->where("id","=",$id)->get(["name"]);
        foreach($user1Names as $user1Name){
            $user1 = $user1Name->name;
        }                
        echo '<script type ="text/JavaScript">';  
        echo 'alert("The name of the pokemon is not correct")';  
        echo '</script>';   
        return view('/combat/choicePokemonUser1', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser1,'user1Name'=>$user1]);

        
    }

    /*
    This function updates the 'participe' table with the chosen pokemon, and redirects to the choice of the next pokemon.
    If the chosen pokemon is invalid (the user made a typo), the page is reloaded.
    When the last pokemon has been chosen, the function redirects to the first fight.
    */
    public function choicePokemonUser1(Request $request){
        $selectedPokemon = DB::table('pokemon_table')->where("name","=",$request->pokemonName)->get(['name']);
        foreach($selectedPokemon as $pokemon){
            $pokemonId = DB::table('pokemon_table')->where("name","=",$pokemon->name)->get(['id']);            
            $max_id = DB::table("combat")->get(["id"])->max('id');
            
            $endOfChoiceOfPokemons = false;
            foreach($pokemonId as $id){
                $idsPokemon21 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon21']);
                foreach($idsPokemon21 as $idPoke21){
                    $idPokemon21 = $idPoke21->id_pokemon21;
                      
                }
                $idsPokemon22 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon22']);
                foreach($idsPokemon22 as $idPoke22){
                    $idPokemon22 = $idPoke22->id_pokemon22;
                }
                $idsPokemon23 = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon23']);
                foreach($idsPokemon23 as $idPoke23){
                    $idPokemon23 = $idPoke23->id_pokemon23;
                }

                if($idPokemon21==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon21"=>$id->id]);
                }         
                else if($idPokemon22==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon22"=>$id->id]);
                }   
                else if($idPokemon23==0){
                    DB::table('participe')->where("id_combat","=",$max_id)->update(["id_pokemon23"=>$id->id]);
                    $endOfChoiceOfPokemons = true;
                }   
            }

            //get the variables needed to render the page of choice of a pokemon (ie the energies and name of the first player)
            $pokemons = DB::table('pokemon_table')->get();
            $max_id = DB::table("combat")->get(["id"])->max('id');
            $idUser1s = DB::table("combat")->where("id","=",$max_id)->get(["id_user1"]);
            foreach ($idUser1s as $id1){
                $idUser1=$id1->id_user1;
            }
            $listEnergiesUser1 = array();
            $energiesUser1 = DB::table("energy_mastered")->where("id_user","=",$idUser1)->get(["id_energy"]);
            foreach($energiesUser1 as $energyUser1){
                $energiesUser1Name = DB::table("energy")->where("id","=",$energyUser1->id_energy)->get(["name"]);
                foreach ($energiesUser1Name as $energyUser1Name){
                    array_push($listEnergiesUser1,$energyUser1Name->name);
                }
            }
            $user1Names = DB::table("users")->where("id","=",$idUser1)->get(["name"]);
            foreach($user1Names as $user1Name){
                $user1 = $user1Name->name;
            } 
            if($endOfChoiceOfPokemons){
                //get all the parameters needed to render the page of fights 
                $max_id = DB::table("combat")->get(["id"])->max('id');
                $idUser1s = DB::table("combat")->where("id","=",$max_id)->get(["id_user1"]);
                foreach ($idUser1s as $id1){
                    $idUser1=$id1->id_user1;
                }
                $user1Names = DB::table("users")->where("id","=",$idUser1)->get(["name"]);
                foreach($user1Names as $user1Name){
                    $user1 = $user1Name->name;
                } 

                $idUser2s = DB::table("combat")->where("id","=",$max_id)->get(["id_user2"]);
                foreach ($idUser2s as $id2){
                    $idUser2=$id2->id_user2;
                }
                $user2Names = DB::table("users")->where("id","=",$idUser2)->get(["name"]);
                foreach($user2Names as $user2Name){
                    $user2 = $user2Name->name;
                }

                $idsPoke = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon11','id_pokemon21']);
                foreach($idsPoke as $idPoke){
                    $id_pokemon11 = $idPoke->id_pokemon11;
                    $id_pokemon21 = $idPoke->id_pokemon21;
                }
                $infosPoke11 = DB::table('pokemon_table')->where("id","=",$id_pokemon11)->get(['name','path','scoreNormalAttack','scoreSpecialAttack','scoreSpecialDefense','pv_max']);
                foreach($infosPoke11 as $infoPoke11){
                    $poke1Name = $infoPoke11->name;
                    $poke1Image = $infoPoke11->path;
                    $poke1ScoreNormalAttack = $infoPoke11->scoreNormalAttack;
                    $poke1ScoreSpecialAttack = $infoPoke11->scoreSpecialAttack;
                    $poke1ScoreSpecialDefense = $infoPoke11->scoreSpecialDefense;
                    $poke1Pv = $infoPoke11->pv_max;
                }
                $infosPoke21 = DB::table('pokemon_table')->where("id","=",$id_pokemon21)->get(['name','path','scoreNormalAttack','scoreSpecialAttack','scoreSpecialDefense','pv_max']);
                foreach($infosPoke21 as $infoPoke21){
                    $poke2Name = $infoPoke21->name;
                    $poke2Image = $infoPoke21->path;
                    $poke2ScoreNormalAttack = $infoPoke21->scoreNormalAttack;
                    $poke2ScoreSpecialAttack = $infoPoke21->scoreSpecialAttack;
                    $poke2ScoreSpecialDefense = $infoPoke21->scoreSpecialDefense;
                    $poke2Pv = $infoPoke21->pv_max;
                }

                $some_data = ['pass','data'];
                //return view('/combat/round', compact('some_data'));
                return view('/combat/round', ['user1'=>$user1,'user2'=>$user2,'poke1Name'=>$poke1Name,'poke1Image'=>$poke1Image,'poke1ScoreNormalAttack'=>$poke1ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke1Pv'=>$poke1Pv,'poke2Name'=>$poke2Name,'poke2Image'=>$poke2Image,'poke2ScoreNormalAttack'=>$poke2ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke2ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke2ScoreSpecialDefense, 'poke2Pv'=>$poke2Pv]);
            }   
            else{            
                return view('/combat/choicePokemonUser1', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser1,'user1Name'=>$user1]);
            }

        }
        //in case the pokemon wasn't found (it the user made a typo), the page is reloaded.
        echo "the name of the pokemon is not correct";
        $pokemons = DB::table('pokemon_table')->get();
        $max_id = DB::table("combat")->get(["id"])->max('id');
        $idUser2s = DB::table("combat")->where("id","=",$max_id)->get(["id_user2"]);
        foreach ($idUser2s as $id2){
            $id=$id2->id_user2;
        }
        $listEnergiesUser2 = array();
        $energiesUser2 = DB::table("energy_mastered")->where("id_user","=",$id)->get(["id_energy"]);
        foreach($energiesUser2 as $energyUser2){
            $energiesUser2Name = DB::table("energy")->where("id","=",$energyUser2->id_energy)->get(["name"]);
            foreach ($energiesUser2Name as $energyUser2Name){
                array_push($listEnergiesUser2,$energyUser2Name->name);
            }
        }
        $user2Names = DB::table("users")->where("id","=",$id)->get(["name"]);
        foreach($user2Names as $user2Name){
            $user2 = $user2Name->name;
        }                
        echo '<script type ="text/JavaScript">';  
        echo 'alert("The name of the pokemon is not correct")';   
        echo '</script>';   
        return view('/combat/choicePokemonUser2', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser2,'user1Name'=>$user2]);
                    
    }

    public function doRound(Request $request){
        //getting the useful information
        $user1 = $request->user1[0];
        $user2 = $request->user2[0];

        $poke1Name = $request->poke1[0];
        $poke1Image = $request->poke1Image[0];
        $poke1ScoreSpecialAttack = $request->poke1ScoreSpecialAttack[0];
        $poke1ScoreSpecialDefense = $request->poke1ScoreSpecialDefense[0];
        $poke1ScoreNormalAttack = $request->poke1ScoreNormalAttack[0];
        $poke1Pv = $request->poke1Pv[0];

        $poke2Name = $request->poke2[0];
        $poke2Image = $request->poke2Image[0];
        $poke2ScoreSpecialAttack = $request->poke2ScoreSpecialAttack[0];
        $poke2ScoreSpecialDefense = $request->poke2ScoreSpecialDefense[0];
        $poke2ScoreNormalAttack = $request->poke2ScoreNormalAttack[0];
        $poke2Pv = $request->poke2Pv[0];

        if((isset($_POST['Attaque_speciale']))) {

            $max_id = DB::table("combat")->get(["id"])->max('id');

            $newPoke2Pv = $poke2Pv - $poke1ScoreSpecialAttack;

            $types = DB::table('types_combat')->where("type","=","attaque speciale")->get(['id']);
            foreach($types as $type){
                $special_attack = $type->id;
            }
            DB::table('tour')->insert([
                'id_combat'=>$max_id,
                'length'=>30,
                'id_type'=>$special_attack,
                'poke1Name'=>$poke1Name,  
                'poke2Name'=>$poke2Name, 
                'poke1Pv'=>$poke1Pv,
                'poke2Pv'=>$newPoke2Pv
            ]);


            if ($newPoke2Pv<=0){
                $newPoke2Pv=0;
                $lastPokemons = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon13','id_pokemon23']);
                //getting the id of the attacked pokemon
                $poke2Ids = DB::table('pokemon_table')->where("name","=",$poke2Name)->get(['id']);
                foreach($poke2Ids as$poke2Id){
                    $poke2Id = $poke2Id->id;
                }
                foreach($lastPokemons as $pokemon){
                    if(strcmp($poke2Id,$pokemon->id_pokemon13)==0 || strcmp($poke2Id,$pokemon->id_pokemon23)==0){
                        //user1 wins, so the number of victories increases
                        $victorious_users = DB::table("users")->get(["name", "nb_victories"])->where("name","=",$user1);
                        foreach($victorious_users as $victorious_user){
                            $winner = $victorious_user->name;
                            DB::table('users')->where("name","=",$victorious_user->name)->update(["nb_victories"=>(($victorious_user->nb_victories)+1)]);
                        }
                        return view('/combat/end', ['winner'=>$winner]);
                    }
                }
                $beforeLastPokemons = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon11','id_pokemon12','id_pokemon13','id_pokemon21','id_pokemon22','id_pokemon23']);
                //Pokemon 2 doesn't have any pv left, it has to be replaced by the next pokemon
                foreach($beforeLastPokemons as $pokemon){
                    if(strcmp($poke2Id,$pokemon->id_pokemon21)==0){//if the current pokemon is the first pokemon of the second player
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon22)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon22)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon23)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon11)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon12)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon12)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon13)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                }
            }
            $poke2Pv = $newPoke2Pv;
            return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$poke2Name,'poke1Image'=>$poke2Image,'poke1ScoreNormalAttack'=>$poke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$poke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$poke2ScoreSpecialDefense, 'poke1Pv'=>$poke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
            

        }


        else if((isset($_POST['Attaque_normale']))) {
           
            $max_id = DB::table("combat")->get(["id"])->max('id');
            
            $newPoke2Pv = $poke2Pv - $poke1ScoreNormalAttack;

            $types = DB::table('types_combat')->where("type","=","attaque normale")->get(['id']);
            foreach($types as $type){
                $normal_attack = $type->id;
            }
            DB::table('tour')->insert([
                'id_combat'=>$max_id,
                'length'=>30,
                'id_type'=>$normal_attack,
                'poke1Name'=>$poke1Name,  
                'poke2Name'=>$poke2Name, 
                'poke1Pv'=>$poke1Pv,
                'poke2Pv'=>$newPoke2Pv
            ]);

            
            if ($newPoke2Pv<=0){
                $newPoke2Pv=0;
                $lastPokemons = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon13','id_pokemon23']);
                //getting the id of the attacked pokemon
                $poke2Ids = DB::table('pokemon_table')->where("name","=",$poke2Name)->get(['id']);
                foreach($poke2Ids as$poke2Id){
                    $poke2Id = $poke2Id->id;
                }
                foreach($lastPokemons as $pokemon){
                    if(strcmp($poke2Id,$pokemon->id_pokemon13)==0 || strcmp($poke2Id,$pokemon->id_pokemon23)==0){
                        //user1 wins, so the number of victories increases
                        $victorious_users = DB::table("users")->get(["name", "nb_victories"])->where("name","=",$user1);
                        foreach($victorious_users as $victorious_user){
                            $winner = $victorious_user->name;
                            DB::table('users')->where("name","=",$victorious_user->name)->update(["nb_victories"=>(($victorious_user->nb_victories)+1)]);
                        }
                        return view('/combat/end', ['winner'=>$winner]);
                    }
                }
                $beforeLastPokemons = DB::table('participe')->where("id_combat","=",$max_id)->get(['id_pokemon11','id_pokemon12','id_pokemon13','id_pokemon21','id_pokemon22','id_pokemon23']);
                //Pokemon 2 doesn't have any pv left, it has to be replaced by the next pokemon
                foreach($beforeLastPokemons as $pokemon){
                    if(strcmp($poke2Id,$pokemon->id_pokemon21)==0){//if the current pokemon is the first pokemon of the second player
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon22)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon22)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon23)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon11)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon12)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                    if(strcmp($poke2Id,$pokemon->id_pokemon12)==0){
                        $nextPokemons = DB::table('pokemon_table')->where("id","=",$pokemon->id_pokemon13)->get(['name','path','scoreSpecialAttack','scoreSpecialDefense','scoreNormalAttack','pv_max']);
                        foreach($nextPokemons as $nextPokemon){
                            $newPoke2Name = $nextPokemon->name;
                            $newPoke2Image = $nextPokemon->path;
                            $newPoke2ScoreNormalAttack = $nextPokemon->scoreNormalAttack;
                            $newPoke2ScoreSpecialAttack = $nextPokemon->scoreSpecialAttack;
                            $newPoke2ScoreSpecialDefense = $nextPokemon->scoreSpecialDefense;
                            $newPoke2Pv = $nextPokemon->pv_max;
                        }
                        return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$newPoke2Name,'poke1Image'=>$newPoke2Image,'poke1ScoreNormalAttack'=>$newPoke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$newPoke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$newPoke2ScoreSpecialDefense, 'poke1Pv'=>$newPoke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
                    }
                }
            }
            $poke2Pv = $newPoke2Pv;
            return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$poke2Name,'poke1Image'=>$poke2Image,'poke1ScoreNormalAttack'=>$poke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$poke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$poke2ScoreSpecialDefense, 'poke1Pv'=>$poke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
        }

        
        else if((isset($_POST['Defense_speciale']))) {
           
            $poke1PvMax1 = DB::table('pokemon_table')->where("name","=",$poke1Name)->get(['pv_max']);
            foreach($poke1PvMax1 as $pv){
                $poke1PvMax = $pv->pv_max;
            }

            $newPoke1Pv = $poke1Pv + $poke1ScoreSpecialDefense;
            if($newPoke1Pv>$poke1PvMax){
                $newPoke1Pv = $poke1PvMax;
            }


            $max_id = DB::table("combat")->get(["id"])->max('id');
            $types = DB::table('types_combat')->where("type","=","defense speciale")->get(['id']);
            foreach($types as $type){
                $defense_speciale = $type->id;
            }
            DB::table('tour')->insert([
                'id_combat'=>$max_id,
                'length'=>30,
                'id_type'=>$defense_speciale,
                'poke1Name'=>$poke1Name,  
                'poke2Name'=>$poke2Name, 
                'poke1Pv'=>$newPoke1Pv,
                'poke2Pv'=>$poke2Pv
            ]);

            $poke1Pv = $newPoke1Pv;
            return view('/combat/round', ['user1'=>$user2,'user2'=>$user1,'poke1Name'=>$poke2Name,'poke1Image'=>$poke2Image,'poke1ScoreNormalAttack'=>$poke2ScoreNormalAttack,'poke1ScoreSpecialAttack'=>$poke2ScoreSpecialAttack,'poke1ScoreSpecialDefense'=>$poke2ScoreSpecialDefense, 'poke1Pv'=>$poke2Pv,'poke2Name'=>$poke1Name,'poke2Image'=>$poke1Image,'poke2ScoreNormalAttack'=>$poke1ScoreNormalAttack ,'poke2ScoreSpecialAttack'=>$poke1ScoreSpecialAttack,'poke2ScoreSpecialDefense'=>$poke1ScoreSpecialDefense, 'poke2Pv'=>$poke1Pv]);
        

        }
    }
}