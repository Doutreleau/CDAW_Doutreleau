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

        foreach($users as $user){
            if (password_verify($request->password, $user->password)) {
                $randomFirstPlayer = random_int(1,2);
                if($randomFirstPlayer==1){
                    $idUser1 = auth()->user()->id;
                    $idUser2 = $user->id;
                }
                else{
                    $idUser2 = auth()->user()->id;
                    $idUser1 = $user->id;

                }

                DB::table('combat')->insert([
                    'mode'=>'manuel et tour par tour', //CAREFUL ! THIS WILL HAVE TO BE CHANGED IN THE FUTURE TO ADD THE OTHER MODES!!!
                    'id_user1'=>$idUser1,
                    'id_user2'=>$idUser2         
                ]);
            }
                
        }
    }
}