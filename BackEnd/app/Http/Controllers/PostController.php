<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function addPost(Request $request){
        $post=post::create([
            "description"=>$request->description,
            "user_id"=>$request->id
         ]);
         return response()->json(['data'=>$post],200);
    }

    public function getPosts(){
        $posts=post::with("user")->get();
        return response()->json(['data'=>$posts],200);
    }

    public function deletepost(int $id){
        $post=post::find($id);
        if($post){
            $post->delete();
            return response()->json(['data'=>"post Deleted"],200);
        }else{
            return response()->json(['data'=>"post Not Found"],404);
        }
       
    }

    public function updatePost(Request $request){
        $post=post::find($request->id);
        if($post){
            $post->update([
                "description"=>$request->description
            ]);
            return response()->json(['data'=>"post updated"],200);
        }else{
            return response()->json(['data'=>"post Not Found"],404);
        }
        
    }
}
