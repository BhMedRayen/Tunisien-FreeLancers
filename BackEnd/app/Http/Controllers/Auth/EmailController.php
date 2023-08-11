<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function VerifyEmail(String $email){
        $user=User::where("email",$email)->first();
        if(!$user){
            return response()->json(["data"=>"User Not Found"],404);
        }
        if(!$user->hasVerifiedEmail()){
            $user->markEmailAsVerified();
            return response()->json(["data"=>"Email has been Verified"],201);
        }else{
            return response()->json(["data"=>"Email Already Verified"],200);
        }
    }

    public function RenvoyerEmail(String $email){
        $user=User::where("email",$email)->first();
        if(!$user){
            return response()->json(["data"=>"User Not Found"],404);
        }
        if($user->hasVerifiedEmail()){
            return response()->json(["data"=>"Email Already Verified"],200);
        }
        Mail::to($email)->send(new VerifyEmail($user));
        return response()->json(["data"=>"Link Verified Send With Success"],200);
    }
}
