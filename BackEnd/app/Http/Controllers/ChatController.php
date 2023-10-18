<?php

namespace App\Http\Controllers;

use App\Events\chatWebsockets;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function GetUser(Request $request){
        if(isset($request->search)){
            if($request->radio=='All'){
                $users=User::where("name","Like","%".$request->search ."%")->get();
            }else if($request->radio=='Freelancer'){
                $users=User::where("IsClient",false)->where("name","Like","%".$request->search ."%")->get();
            }else{
                $users=User::where("IsClient",true)->where("name","Like","%".$request->search ."%")->get();
            }
        }else{
            if($request->radio=='All'){
                $users=User::all();
            }else if($request->radio=='Freelancer'){
                $users=User::where("IsClient",false)->get();
            }else{
                $users=User::where("IsClient",true)->get();
            }
        }
       
          return response()->json(['data'=>$users],200);
    }


    public function addMessage(Request $request){
        $message=new Message();
        $message->user_send=$request->user_id;
        $message->user_recu=$request->id;
        $message->text=$request->text;
        $message->save();
        broadcast(new chatWebsockets());
        return response()->json(['data'=>$message],201);
    }

    // function get message 
   public function getMessages(int $id,int $user_id){
       $messages=Message::where("user_send",$user_id)->where("user_recu",$id)->
        OrWhere("user_send",$id)->where("user_recu",$user_id)->orderBy('created_at')->get();
    return response()->json(["data"=>$messages],200);
   }
}
