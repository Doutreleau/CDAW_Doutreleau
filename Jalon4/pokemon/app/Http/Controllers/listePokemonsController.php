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
        return view('userPage');
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
}