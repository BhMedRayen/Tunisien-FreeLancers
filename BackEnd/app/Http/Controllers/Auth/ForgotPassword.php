<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPassword extends Controller
{
    public function forgotPasswordToken(String $email){
        $user=User::where("email",$email)->first();
        if($user){
            $token=mt_rand(1000,9999);
            $user->password_Token=$token;
            $user->Password_send_at=now();
            $user->save();
            Mail::to($email)->send(new MailForgotPassword($token));
            return response()->json(["data"=>"Token Send"],201);
        }else{
            return response()->json(["data"=>"user not found"],404);
        }
    }

    public function VerifyToken(Request $request){
        $user=User::where("email",$request->email)->where("password_Token",$request->token)->first();
        if($user){
            /*$tokenCreationTime = $user->Password_send_at; 
            $expirationTime = Carbon::parse($tokenCreationTime)->addHour();
            if($expirationTime > now()){
                return response()->json(["data"=>"Token Expired"],404);
            }else{*/
                return response()->json(["data"=>"Email And Token Correct"],200);
            //}
        }else{
            return response()->json(["data"=>"Email Or Token not found"],404);
        }
    }

    public function ChangerPassword(Request $request){
        $user=User::where("email",$request->email)->first();
        if($user){
            $user->update([
                "password"=>bcrypt($request->password),
                "password_Token"=>null,
                "Password_send_at"=>null
            ]);
            return response()->json(["data"=>"Password Changed with success"],200);
        }else{
            return response()->json(["data"=>"user not found"],404);
        }
    }
}
