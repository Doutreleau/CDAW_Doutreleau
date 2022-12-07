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

    public function loginSecondUser(Request $request){
        $mailUser2 = $request ->email;
        $users = DB::table('users')->get()->where("email","=",$mailUser2);

        $correctPassword = false;
        foreach($users as $user){
            if (password_verify($request->password, $user->password)) {
                $correctPassword = true;
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


    public function choicePokemonUser2(Request $request){
        echo $request->pokemonName;

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

    public function choicePokemonUser1(Request $request){
        echo $request->pokemonName;

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
        return view('/combat/choicePokemonUser1', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser1,'user1Name'=>$user1]);
            
    }
}