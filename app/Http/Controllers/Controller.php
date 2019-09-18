<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Ship;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $ships;
    public function __construct()
    {
        $this->ships = Ship::all();
        View::share('ships', $this->ships);

    }
    public function mark_as_read($id){

        $u = User::find($id);
        if ($u){
            $u->unreadNotifications->markAsRead();
            return 'yes';
        }else{
            return 'no';
        }
    }
    public function loadMore($id, $take){
        $u = User::find($id);
        if ($u){
            $nn = $u->notifications->splice($take,10);
            $data = '';
            if ($nn->count()>0){
                foreach ($nn as $n){
                    if ($n->read_at != ''){
                        $read = 'green';
                    }else{
                        $read = 'pulse red';
                    }

                    $data.='<li><a class="grey-text text-darken-2" href="'.($n->data['action']?:'#!').'"><span class="material-icons icon-bg-circle small '.$read.'">'.$n->data['icon'].'</span>'.$n->data['msg'].'</a>
                            <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">'.Carbon::createFromFormat('Y-m-d H:i:s', $n->created_at)->diffForHumans().'</time>
                        </li>';
                }
                return $data;
            }else{
                return 'no';
            }

        }else{
            return 'no';
        }
    }
    public function mark_read($id){
        $n = Notification::find($id);
        $n->read_at = date('Y-m-d H:i:s');
        $n->save();
        return 'yes';
    }

}
