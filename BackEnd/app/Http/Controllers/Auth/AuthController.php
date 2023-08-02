<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Register(Request $request){
        if($request->hasFile("photo")){
            $file_name=time().'_'.$request->photo->getClientOriginalName();
            $image=$request->file("photo")->storeAs("Users",$file_name,"public");
            $image_path="/storage/".$image;
        }else{
            if($request->sex=="man"){
                $image_path="/storage/image/ParDefaut/homme.png";
            }else{
                $image_path="/storage/image/ParDefaut/femme.jpeg";
            }
        }

        $user=User::create([
            "name"=>$request->name,
            "lastName"=>$request->lastname,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "Photo"=>$image_path,
            "IsClient"=>$request->ClientChoice==true ? true :false,
            "sex"=>$request->sex,
            "cin"=>$request->cin,
            "num_tlf"=>$request->num_tlf
        ]);
        
        return response()->json(["data"=>"User Created"],201);
    }
}
