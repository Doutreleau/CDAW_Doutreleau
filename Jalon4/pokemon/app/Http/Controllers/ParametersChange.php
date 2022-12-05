<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Energy;
use Illuminate\Support\Facades\DB;

class ParametersChange extends Controller
{
    public function changeName(Request $request){
        //need to check if the password is correct...

        $user = auth()->user();

        if (password_verify($request->password, $user->password)) {
            // Success
        
            $userId = $user->id;
            $newName= $request->newName;
            DB::table('users')->where("id","=",$userId)->update(["name"=>$newName]);
            return redirect()->to('/user');
        }
        else{
            echo '<script>alert("The password is incorrect")</script>';
            return view('changeName');
        }
    }

    public function getChangeName(){
        return view('changeName');
    }



    public function changeMail(Request $request){
        //need to check if the password is correct...

        $user = auth()->user();

        if (password_verify($request->password, $user->password)) {
            // Success
        
            $userId = $user->id;
            $newMail= $request->newMail;
            DB::table('users')->where("id","=",$userId)->update(["email"=>$newMail]);
            return redirect()->to('/user');
        }
        else{
            echo '<script>alert("The password is incorrect")</script>';
            return view('changeMail');
        }
    }

    public function getChangeMail(){
        return view('changeMail');
    }

    public function changePassword(Request $request){
        //need to check if the password is correct...

        $user = auth()->user();

        if (password_verify($request->password, $user->password)) {
            // Success
        
            $userId = $user->id;
            $newPassword= $request->newPassword;
            DB::table('users')->where("id","=",$userId)->update(["password"=>bcrypt($newPassword)]);
            return redirect()->to('/user');
        }
        else{
            echo '<script>alert("The password is incorrect")</script>';
            return view('changePassword');
        }
    }

    public function getChangePassword(){
        return view('changePassword');
    }

}