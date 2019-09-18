<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request){
        $loggedUser = Auth::user();
        $take = $request->input('take')? $request->input('take') :0;
        if ($request->input('take')>0){
            $n = $loggedUser->notifications->splice($request->input('take'),10);
        }else{
            $n = $loggedUser->notifications->take(10);
        }


        $unread = $loggedUser->unreadNotifications->count();
        if ($n->count()>0){
            return response()->json([
                'unread' => $unread,
                'notifications'=> $loggedUser->notifications->splice($take,10),
            ]);
        }else{
            return response()->json([
                'unread' => $unread,
                'notifications'=> 'no',
            ]);
        }

    }
    public function mark_all_read(){

        $u  = Auth::user();
        $u->unreadNotifications->markAsRead();
        return response()->json([
            'notify' => [
                'title' => 'Success !',
                'type' => 'success',
                'message' => 'All notification marked read.'
            ]
        ]);
    }
    public function mark_read($id){
        $n = Notification::find($id);
        $n->read_at = date('Y-m-d H:i:s');
        $n->save();
        return 'yes';
    }
}
