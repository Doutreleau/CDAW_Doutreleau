<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::create(request(['name', 'email', 'password']));

        //give the user a random mastered energy
        $numEnergies = DB::table("energy")->count();
        $idRandomEnergyGiven = random_int(1,$numEnergies);

        $idUser = $user -> id;

        DB::table('energy_mastered')->insert([
            'id_user' => $idUser,
            'id_energy' => $idRandomEnergyGiven
            ]);         
        
        auth()->login($user);
        
        return redirect()->to('/user');
    }
}
