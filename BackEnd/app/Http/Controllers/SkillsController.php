<?php

namespace App\Http\Controllers;

use App\Models\ServiceFreelancer;
use Illuminate\Http\Request;

class SkillsController extends Controller
{

    public function getSkill(int $id){
        $skills=ServiceFreelancer::where("user_id",$id)->get();
        return response()->json(['data'=>$skills],201);
    }
    public function AddSkill(Request $request){
        $skill=ServiceFreelancer::create([
            "Name_Service"=>$request->name,
            "YearsBusiness"=>$request->years,
            "TypeService"=>$request->type,
            "PrincesRange"=>$request->price,
            "user_id"=>$request->userid
        ]);
        $skills=ServiceFreelancer::where("user_id",$request->userid)->get();
        return response()->json(['data'=>$skills],201);
    }

    public function DeleteSkill(int $id){
        $skill=ServiceFreelancer::find($id);
        if($skill){
            $skill->delete();
            return response()->json(['data'=>"Servcie deleted"],200);
        }else{
            return response()->json(['data'=>"Service Not Found"],404);
        }
    }

    public function UpdateService(int $id,Request $request){
        $skill=ServiceFreelancer::find($id);
        if($skill){
            $skill->update([
                "Name_Service"=>$request->name,
                "YearsBusiness"=>$request->years,
                "TypeService"=>$request->type,
                "PrincesRange"=>$request->price,
            ]);
            return response()->json(['data'=>"Servcie Updated"],200);
        }else{
            return response()->json(['data'=>"Service Not Found"],404);
        }
    }
}
