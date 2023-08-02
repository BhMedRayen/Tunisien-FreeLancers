<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
             $authUser=Auth::user();
             if(!$authUser->hasVerifiedEmail()){
                return response()->json(["message"=>"Your Email is not Verifed"],404);
             }
             $data["Role"]=$authUser->IsClient ? "Client" : "Freelancer";
             $data["token"]=$authUser->createToken("api_token")->plainTextToken;
             $data["user"]=$authUser;
             return response()->json(["data"=>$data],200);
        }else{
            return response()->json(["data"=>"User Not Found"],404);
        }
    }
}
