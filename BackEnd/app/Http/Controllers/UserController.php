<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 
    public function updateUser(int $id,Request $request)

    {
        $user = User::find($id);
        if($user==null)
        {
            return response()->json(['user'=>'User Not Found'],404);
        }
       
        $file_name=time().'_'.$request->photo->getClientOriginalName();
        $image=$request->file("photo")->storeAs("image/Users",$file_name,"public");
        $image_path="/storage/".$image;

        $user->update([
            'name'=>$request->name,
            'lastName'=>$request->lastname,
            'password'=>bcrypt($request->password),
            "Photo"=>$image_path,
        ]);
        return response()->json(['data'=>$user],200);
    }
}
