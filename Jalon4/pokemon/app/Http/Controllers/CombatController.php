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
                $idUser1 = DB::table("combat")->where("id","=",$max_id)->get(["id_user1"]);
                foreach ($idUser1 as $id1){
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
                return view('/combat/choiceFirstPokemon', ['pokemons' => $pokemons,'listEnergiesUser1' => $listEnergiesUser1]);
            }                
        }
        if (!$correctPassword){
            echo '<script>alert("The password is incorrect")</script>';
            return view('/combat/choiceSecondUser');
        }
    }
}