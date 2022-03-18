<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\User;

class CustomAuth extends Controller
{
    use ApiResponser;

    public function login(Request $request){
        if(User::where("username",$request->username)->exists()){
            $user = User::where("username",$request->username)->first();
        }else{
            $user = new User();
            $user->type = $request->role;
            $user->username = $request->username;
            $user->save();
        }

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
            "user" => $user
        ]);
    }

}
