<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Notification;
use App\Models\post;
use App\Models\User;
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

    public function getPostsUser(int $id){
        $posts=post::with("user")->where("user_id",$id)->get();
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

    public function getComments(int $id){
        $comments=comment::with("user")->where("post_id",$id)->get();
        return response()->json(['data'=>$comments],200);
    }

    public function ajouterComment(Request $request){
         $post=post::with("user")->where("id",$request->idpost)->first();
         $user=User::where("id",$request->id)->get();
         $notif=new Notification();
         $notif->user_id= $post['user']->id;
         $notif->message=$user[0]->name . " Comment un post";
         $notif->save();
         $comment=comment::create([
            "user_id"=>$request->id,
            "post_id"=>$request->idpost,
            "comment"=>$request->comment
        ]);
        return response()->json(['data'=>$comment],201);
    }

    
}
