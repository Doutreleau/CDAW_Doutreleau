<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Energy;
use Illuminate\Support\Facades\DB;

class listePokemonsController extends Controller
{
    public function welcome(){
        return view('welcomePage');
    }

    //returns the page of the user
    public function userPage(){
        $userId = auth()->user()->id;
        $energies = DB::table("energy_mastered")->get(["id_user", "id_energy"])->where("id_user","=",$userId);
        foreach($energies as $energy){
            
            $energiesNames = DB::table("energy")->get(["id", "name"])->where("id","=",$energy->id_energy);

        return view('userPage', ['energiesNames' => $energiesNames]);
        }
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pokemons = DB::table('pokemon_table')->get();
 
        return view('listePokemons', ['pokemons' => $pokemons]);
    }

    public function parametersPage(){
        return view('/parameters/parametersPage');
    }

    public function playerStat(){
        $users = DB::table('users')->get();
        return view('/playerStat', ['users' => $users]);
    }

    public function chooseMatchToReplay(){
        $matches = DB::table('combat')->get();
        return view('/chooseMatchToReplay', ['matches' => $matches]);
    }

    public function replayMatch(Request $request){
        
        $matchId = $request ->matchId;
        return view('/replayMatch', ['matchId' => $matchId]);
    }

    public function help(){
        return view('/help');
    }
}