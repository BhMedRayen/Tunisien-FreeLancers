<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotifController extends Controller
{
   public function getNotification(int $id){
    $notifications=Notification::where("user_id",$id)->get();
    if($notifications){
        return response()->json(['data'=>$notifications],200);
    }else{
        return response()->json(['data'=>"notifications Not Found"],404);
    }
   
   }

   public function DeleteNotif(int $id){
    $Notification=Notification::find($id);
    if($Notification){
        $Notification->delete();
        return response()->json(['data'=>"Notification Deleted"],200);
    }else{
        return response()->json(['data'=>"Notification Not Found"],404);
    }
   }


}
