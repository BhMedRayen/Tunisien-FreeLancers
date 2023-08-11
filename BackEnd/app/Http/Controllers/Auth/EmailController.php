<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function VerifyEmail(String $email){
        $user=User::where("email",$email)->first();
        if($user->hasVerifiedEmail()){
            return response()->json(["data"=>"Email Already Verified"],200);
        }else{
            $user->markEmailAsVerified();
            return response()->json(["data"=>"Email has been Verified"],201);
        }
    }
}
