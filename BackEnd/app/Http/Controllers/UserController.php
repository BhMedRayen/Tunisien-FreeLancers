<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::where('name','like','b%')->get();
        return response()->json(['data'=>$users],200);
    }
    public function getUser(int $id)
    {
        $user = User::find($id);
        if($user==null)
        {
            return response()->json(['user'=>'User Not Found'],404);

        }
        return response()->json(['user'=>$user],200);
    }
    public function deleteUser(int $id)
    {
        $user = User::find($id);
        if($user==null)
        {
            return response()->json(['user'=>'User Not Found'],404);

        }
        $user->delete();
        return response()->json(['Message'=>'User Deleted'],200);
    }
    public function addUser(Request $request)
    {
        // $user=new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        return response()->json(['new_user'=>$user],201);
    }
    public function updateUser(int $id,Request $request)

    {
        $user = User::find($id);
        if($user==null)
        {
            return response()->json(['user'=>'User Not Found'],404);
        }
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        return response()->json(['update_user'=>'update success'],200);
    }
}
