<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Energy;

class listePokemonsController extends Controller
{
    public function show($param){
        foreach (Energy::all() as $energy) {
            echo $energy->name;
        }
        return view('listePokemons',['param'=>$param]);
    }


}