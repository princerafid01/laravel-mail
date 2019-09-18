<?php

namespace App\Http\Controllers;

use App\Notifications\GeneralNotification;
use App\Ship;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CronController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function cron(){
        $trips = Trip::where('finished','!=', 1)->get();
        $today = Carbon::today();
        foreach ($trips as $trip){
            if ($trip->start_date == null)
                continue;
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $trip->start_date);
            $duration = 0;
            if ($trip->end_date){
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $trip->end_date);
                $duration = $start->diffInDays($end_date)+1;
            }else{
                $duration = $start->diffInDays($today)+1;
            }
            $sailing = 0;
            if ($trip->sailing_start && $trip->sailing_end){
                $sailing_start = Carbon::createFromFormat('Y-m-d H:i:s', $trip->sailing_start);
                $sailing_end = Carbon::createFromFormat('Y-m-d H:i:s', $trip->sailing_end);
                $sailing = $sailing_start->diffInDays($sailing_end)+1;
                if ($start->isSameDay($sailing_start)){
                    $sailing-=1;
                }
                if (isset($end_date) && $end_date->isSameDay($sailing_end)){
                    $sailing-=1;
                }
            }elseif ($trip->sailing_start && !$trip->sailing_end){
                $sailing_start = Carbon::createFromFormat('Y-m-d H:i:s', $trip->sailing_start);
                $sailing = ($sailing_start->diffInDays($today)+1);
                if ($start->isSameDay($sailing_start)){
                    $sailing-=1;
                }
            }
            $duration =  $duration-$sailing;
            $trip->duration=$duration;
            $dt = $trip->ship->double_trip;
            $td = $dt+17;

            $users = User::where('active',1)->get();
            if ($trip->type == 'Single'){
                if ($duration == $dt+1){
                    $trip->type = 'Double';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip today', route('TripViewPrint', ['id'=>$trip->id])));
                }elseif($duration>$dt){
                    $trip->type = 'Double';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip '.($duration-$dt).' days before on '.$today->subDays($duration-$dt)->format(option('date_format')), route('TripViewPrint', ['id'=>$trip->id])));
                }elseif ($duration >($dt-5) || $duration == ($dt-10)){
                    $d_day = $start->addDays($dt)->addDays($sailing);
                    $d = $d_day->diffInDays($today) ==1? 'tomorrow': 'after '.$d_day->diffInDays($today). 'days on '.$d_day->format(option('date_format')) ;
                    if (!$trip->end_date)
                    Notification::send($users, new GeneralNotification($trip->number.' is becoming Double trip '.$d, route('TripViewPrint', ['id'=>$trip->id])));
                }
            }elseif ($trip->type == 'Double'){
                if ($duration>($td)){
                    $trip->type = 'Triple';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Triple Trip today', route('TripViewPrint', ['id'=>$trip->id])));
                }elseif ($duration>($td-5) || $duration==($td-10)){
                    $d_day = $start->addDays($dt+17)->addDays($sailing);
                    $d = $d_day->diffInDays($today) ==1? 'tomorrow': 'after '.$d_day->diffInDays($today). ' days on '.$d_day->format(option('date_format')) ;
                    if (!$trip->end_date)
                    Notification::send($users, new GeneralNotification($trip->number.' is becoming Triple trip '.$d, route('TripViewPrint', ['id'=>$trip->id])));
                }
            }
            $trip->save();
        }
        if ($today->isSameDay($today->copy()->startOfMonth())){
          $ships = Ship::all();
          foreach ($ships as $ship){
              $ship->trip_o = 1;
              $ship->save();
          }
        }
    }
}
