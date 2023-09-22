<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\ServiceFreelancer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function Register(Request $request){
        if($request->hasFile("photo")){
            $file_name=time().'_'.$request->photo->getClientOriginalName();
            $image=$request->file("photo")->storeAs("image/Users",$file_name,"public");
            $image_path="/storage/".$image;
        }else{
            // return response()->json(["data"=>$request->sex],201);
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
            "IsClient"=>$request->ClientChoice=="Client" ? true :false,
            "sex"=>$request->sex,
            "cin"=>$request->cin,
            "num_tlf"=>$request->num_tlf
        ]);
       
        if($request->ClientChoice!="Client"){
            $servicesData = json_decode($request->Services, true);
            if(isset($servicesData) && is_array($servicesData) && count($servicesData)>0){
                for($i=0;$i<=count($servicesData);$i++){
                    $service=new ServiceFreelancer();                
                    $service->Name_Service=$servicesData[$i]["Name"];
                    $service->YearsBusiness=$servicesData[$i]["Years"];
                    $service->TypeService=$servicesData[$i]["Type"];
                    $service->PrincesRange=$servicesData[$i]["price"];
                    $service->user_id=$user->id;
                    $service->save();
                }
            }
         
        }

        Mail::to($request->email)->send(new VerifyEmail($user));

        return response()->json(["data"=>"User Created"],201);
    }
}
