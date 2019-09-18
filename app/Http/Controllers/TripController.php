<?php

namespace App\Http\Controllers;

use App\Notifications\GeneralNotification;
use App\Ship;
use App\Transaction;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use function Sodium\increment;

class TripController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index(){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('trip_view'))
            abort(403);
        $meta = array(
            'page_title' => 'Trips',
            'active_page'=>'trips',
            'active_menu'=> 'trips',
            'bc'=> array(
                'Home' => url('/'),
                'Trip'=>'active'
            ),
        );
        return view('trips.index', compact('meta'));
    }
    public function tripList(Request $request){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('trip_view'))
            abort(403);
        $trips = Trip::with('ship')->with('created_by');
        if (!$loggedUser->can('view_all')){
            $trips =  $trips->where('created_by', $loggedUser->id);
        }
        if ($request->filled('ship_id'))
            $trips =  $trips->where('ship_id', $request->input('ship_id'));
        if ($request->filled('from'))
            $trips =  $trips->where('from','like', '%'.$request->input('from').'%');
        if ($request->filled('to'))
            $trips =  $trips->where('to','like', '%'.$request->input('to').'%');
        if ($request->filled('month'))
            $trips = $trips->whereMonth('start_date', Carbon::createFromFormat('Y-m-d',$request->input('month')));
        if ($request->filled('start_date1') && !$request->filled('start_date2')){
            $trips = $trips->whereDate('start_date', Carbon::createFromFormat('Y-m-d',$request->input('start_date1')));
        }elseif ($request->filled('start_date1') && $request->filled('start_date2')){
            $trips = $trips->whereBetween('start_date', [$request->input('start_date1'), $request->input('start_date2')]);
        }
        if ($request->filled('end_date1') && !$request->filled('end_date2')){
            $trips = $trips->whereDate('end_date', Carbon::createFromFormat('Y-m-d',$request->input('end_date1')));
        }elseif ($request->filled('end_date1') && $request->filled('end_date2')){
            $trips = $trips->whereBetween('end_date', [$request->input('end_date1'), $request->input('end_date2')]);
        }
        if ($request->filled('cargo_quantity1') && !$request->filled('cargo_quantity2')){
            $trips = $trips->where('cargo_quantity', $request->input('cargo_quantity1'));
        }elseif ($request->filled('cargo_quantity1') && $request->filled('cargo_quantity2')){
            $trips = $trips->whereBetween('cargo_quantity', [$request->input('cargo_quantity1'), $request->input('cargo_quantity2')]);
        }
        if ($request->filled('fuel1') && !$request->filled('fuel2')){
            $trips = $trips->where('total_fuel', $request->input('fuel1'));
        }elseif ($request->filled('fuel1') && $request->filled('fuel2')){
            $trips = $trips->whereBetween('fuel', [$request->input('fuel1'), $request->input('fuel2')]);
        }
        if ($request->filled('income1') && !$request->filled('income2')){
            $trips = $trips->where('income', $request->input('income1'));
        }elseif ($request->filled('income1') && $request->filled('income2')){
            $trips = $trips->whereBetween('income', [$request->input('income1'), $request->input('income2')]);
        }
        if ($request->filled('expense1') && !$request->filled('expense2')){
            $trips = $trips->where('expense', $request->input('expense1'));
        }elseif ($request->filled('expense1') && $request->filled('expense2')){
            $trips = $trips->whereBetween('expense', [$request->input('expense1'), $request->input('expense2')]);
        }
        if ($request->filled('cargo'))
            $trips =  $trips->where('cargo','like', '%'.$request->input('cargo').'%');
        if ($request->filled('type'))
            $trips =  $trips->where('type', $request->input('type'));
        if ($request->filled('status'))
            $trips =  $trips->where('status', $request->input('status'));

        $trips = $trips->orderBy('created_at', 'desc')->get();
        $date_format = option('date_format');
        return datatables()->of($trips)
            ->editColumn('start_date', function ($trip) use ($date_format){
                if ($trip->start_date){
                    return date($date_format, strtotime($trip->start_date));
                }else{
                    return '';
                }

            })
            ->toJson();
    }
    public function addTrip(Request $request){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('trip_add'))
            abort(403);
        if ($request->isMethod('post')){
            Validator::make($request->all(),[
                'ship_id'=>'required'
            ])->validate();
            $ship = Ship::findOrfail($request->input('ship_id'));
            $trip = new Trip;
            if ($request->filled('start_date')){
                $trip->number = $ship->prefix.'.'.strtoupper(date('Y.M.', strtotime($request->input('start_date')))).'TRIP-'. sprintf("%02d", $ship->trip_o);
            }else{
                $trip->number = $ship->prefix.'.'.strtoupper(date('Y.M.')).'TRIP-'. sprintf("%02d", $ship->trip_o);
            }
            $trip->ship_id = $ship->id;
            $trip->from = $request->input('from');
            $trip->to = $request->input('to');
            $trip->start_date = $request->input('start_date');
            $trip->sailing_start = $request->input('sailing_start');
            $trip->sailing_end = $request->input('sailing_end');
            $trip->end_date = $request->input('end_date');
            $trip->cargo = $request->input('cargo');
            $trip->cargo_quantity = $request->input('cargo_quantity');
            $trip->total_fuel = $request->input('total_fuel');
            $trip->status = $request->input('status');
            $trip->type = $request->input('type');
            $trip->user_id = $loggedUser->id;
            $trip->save();
            $ship->increment('trip_o');
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification($trip->number.' has been added by '.$loggedUser->name, route('TripViewModal', ['id'=>$trip->id]), 'remote_b'));
            $request->session()->flash('success', 'Trip added');
            $date_format = option('date_format');
            $users = User::where('active',1)->get();
            $date_format = option('date_format');
            if($request->filled('start_date')){
                $trip = Trip::find($trip->id);
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $trip->start_date);
                $today = Carbon::today();
                $duration = 0;
                if ($trip->end_date){
                    $trip->finished = 1;
                    $end_date = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->end_date);
                    $duration = $start->diffInDays($end_date)+1;
                }else{
                    $trip->finished = 0;
                    $duration = $start->diffInDays($today)+1;
                }
                $sailing = 0;
                if ($trip->sailing_start && $trip->sailing_end){
                    $sailing_start = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->sailing_start);
                    $sailing_end = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->sailing_end);
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
                $tp = $dt + 17;
            }
            if ($trip->start_date && $trip->sailing_start && $trip->sailing_end && !$trip->end_date){
                $d_day = $start->copy()->addDays($dt)->addDays($sailing);
                $t_day =  $start->copy()->addDays($tp)->addDays($sailing);
                if ($duration > ($tp+1)){
                    $trip->t_day = $t_day;
                    $trip->type = 'Triple';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Triple Trip '.($duration-$tp).' days before on '.$today->subDays($duration-($tp))->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                }elseif ($duration == ($tp+1)){
                    $trip->t_day = $t_day;
                    $trip->type = 'Triple';
                    Notification::send($users, new GeneralNotification($trip->number.' is become Triple trip Today', route('TripViewPrint', ['id'=>$trip->id])));
                }elseif($duration>($dt+1)){
                    $trip->d_day = $d_day;
                    $trip->type = 'Double';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip '.($duration-$dt).' days before on '.$today->subDays($duration-$dt)->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                }elseif ($duration == ($dt+1)){
                    $trip->d_day = $d_day;
                    $trip->type = 'Double';
                    Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip today', route('TripViewPrint', ['id'=>$trip->id])));
                }else{
                    $trip->type = 'Single';
                    $trip->d_day = $d_day;
                    $d = $d_day->diffInDays($today) ==1? 'tomorrow': 'after '.$d_day->diffInDays($today). 'days on '.$d_day->format($date_format) ;
                    Notification::send($users, new GeneralNotification($trip->number.' will become Double trip '.$d, route('TripViewPrint', ['id'=>$trip->id])));
                }
                $trip->save();
            }elseif ($trip->start_date && $trip->sailing_start && $trip->sailing_end && $trip->end_date){
                $d_day = $start->copy()->addDays($dt)->addDays($sailing);
                $t_day =  $start->copy()->addDays($tp)->addDays($sailing);
                if ($duration > $tp){
                    $trip->type = 'Triple';
                    $trip->t_day = $t_day;
                    Notification::send($users, new GeneralNotification($trip->number.' is Triple Trip and it become Triple trip on '.$t_day->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                }elseif ($duration > $dt){
                    $trip->d_day = $d_day;
                    $trip->type = 'Double';
                    Notification::send($users, new GeneralNotification($trip->number.' is Double Trip and it become Double trip on '.$d_day->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                }else{
                    $trip->type = 'Single';
                }
                $trip->save();
            }else{
                $trip->save();
            }
            return redirect('/trips');
        }
        $meta = array(
            'page_title' => 'Add trip',
            'active_page'=>'trips',
            'active_menu'=> 'trips',
            'bc'=> array(
                'Home' => url('/'),
                'Trips' => url('/trips'),
                'Add trip'=>'active'
            ),
        );
        $ship_id = null;
        if ($request->filled('ship_id')){
            $ship_id = $request->input('ship_id');
        }
        return view('trips.add_trip', compact('meta','ship_id'));
    }
    public function editTrip(Request $request, $id){
        $loggedUser = Auth::user();
        $trip = Trip::findOrfail($id);
        if (!$loggedUser->can('trip_edit'))
            abort(403);
        if (!$loggedUser->can('view_all') && $trip->user_id != $loggedUser->id)
            abort(403);
        if ($request->isMethod('post')){
            $calculate = false;
            if (($trip->start_date != $request->input('start_date').($request->input('start_date')?' 00:00:00':'')) || ($trip->sailing_start != $request->input('sailing_start').($request->input('sailing_start')?' 00:00:00':'')) || ($trip->sailing_end != $request->input('sailing_end').($request->input('sailing_end')?' 00:00:00':'')) || ($trip->end_date != $request->input('end_date').($request->input('end_date')?' 00:00:00':''))){
                $calculate = true;
            }
            $trip->from = $request->input('from');
            $trip->to = $request->input('to');
            $trip->start_date = $request->input('start_date');
            $trip->sailing_start = $request->input('sailing_start');
            $trip->sailing_end = $request->input('sailing_end');
            $trip->end_date = $request->input('end_date');
            $trip->cargo = $request->input('cargo');
            $trip->cargo_quantity = $request->input('cargo_quantity');
            $trip->total_fuel = $request->input('total_fuel');
            $trip->status = $request->input('status');
            $trip->type = $request->input('type');
            $trip->save();
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification($trip->number.' has been edited by '.$loggedUser->name, route('TripViewModal', ['id'=>$trip->id]), 'remote_b'));
            $request->session()->flash('success', 'Trip updated');
            if ($calculate){
                $users = User::where('active',1)->get();
                $date_format = option('date_format');
                if($request->filled('start_date')){
                    $trip = Trip::find($trip->id);
                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $trip->start_date);
                    $today = Carbon::today();
                    $duration = 0;
                    if ($trip->end_date){
                        $trip->finished = 1;
                        $end_date = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->end_date);
                        $duration = $start->diffInDays($end_date)+1;
                    }else{
                        $trip->finished = 0;
                        $duration = $start->diffInDays($today)+1;
                    }
                    $sailing = 0;
                    if ($trip->sailing_start && $trip->sailing_end){
                        $sailing_start = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->sailing_start);
                        $sailing_end = Carbon::createFromFormat('Y-m-d  H:i:s', $trip->sailing_end);
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
                    $tp = $dt + 17;
                }
                if ($trip->start_date && $trip->sailing_start && $trip->sailing_end && !$trip->end_date){
                    $d_day = $start->copy()->addDays($dt)->addDays($sailing);
                    $t_day =  $start->copy()->addDays($tp)->addDays($sailing);
                    if ($duration > ($tp+1)){
                        $trip->t_day = $t_day;
                        $trip->type = 'Triple';
                        Notification::send($users, new GeneralNotification($trip->number.' has become Triple Trip '.($duration-$tp).' days before on '.$today->subDays($duration-($tp))->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                    }elseif ($duration == ($tp+1)){
                        $trip->t_day = $t_day;
                        $trip->type = 'Triple';
                        Notification::send($users, new GeneralNotification($trip->number.' is become Triple trip Today', route('TripViewPrint', ['id'=>$trip->id])));
                    }elseif($duration>($dt+1)){
                        $trip->d_day = $d_day;
                        $trip->type = 'Double';
                        Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip '.($duration-$dt).' days before on '.$today->subDays($duration-$dt)->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                    }elseif ($duration == ($dt+1)){
                        $trip->d_day = $d_day;
                        $trip->type = 'Double';
                        Notification::send($users, new GeneralNotification($trip->number.' has become Double Trip today', route('TripViewPrint', ['id'=>$trip->id])));
                    }else{
                        $trip->type = 'Single';
                        $trip->d_day = $d_day;
                        $d = $d_day->diffInDays($today) ==1? 'tomorrow': 'after '.$d_day->diffInDays($today). 'days on '.$d_day->format($date_format) ;
                        Notification::send($users, new GeneralNotification($trip->number.' will become Double trip '.$d, route('TripViewPrint', ['id'=>$trip->id])));
                    }
                    $trip->save();
                }elseif ($trip->start_date && $trip->sailing_start && $trip->sailing_end && $trip->end_date){
                    $d_day = $start->copy()->addDays($dt)->addDays($sailing);
                    $t_day =  $start->copy()->addDays($tp)->addDays($sailing);
                    if ($duration > $tp){
                        $trip->type = 'Triple';
                        $trip->t_day = $t_day;
                        Notification::send($users, new GeneralNotification($trip->number.' is Triple Trip and it become Triple trip on '.$t_day->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                    }elseif ($duration > $dt){
                        $trip->d_day = $d_day;
                        $trip->type = 'Double';
                        Notification::send($users, new GeneralNotification($trip->number.' is Double Trip and it become Double trip on '.$d_day->format($date_format), route('TripViewPrint', ['id'=>$trip->id])));
                    }else{
                        $trip->type = 'Single';
                    }
                    $trip->save();
                }else{
                    $trip->save();
                }
            }
            return redirect('/trips');
        }
        $meta = array(
            'page_title' => 'Edit trip ('.$trip->number.')',
            'active_page'=>'trips',
            'active_menu'=> 'trips',
            'bc'=> array(
                'Home' => url('/'),
                'Trips' => url('/trips'),
                'Edit trip ('.$trip->number.')'=>'active'
            ),
        );
        return view('trips.edit_trip', compact('meta', 'trip'));
    }
    public function deleteTrip($id){
        $loggedUser = Auth::user();
        $trip = Trip::findOrfail($id);
        if (!$loggedUser->can('trip_delete'))
            abort(403);
        if (!$loggedUser->can('view_all') && $trip->user_id != $loggedUser->id)
            abort(403);
        $trip->delete();
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        Notification::send($users, new GeneralNotification($trip->number.' has been deleted by '.$loggedUser->name));
        session()->flash('success', 'Trip deleted');
        return redirect('/trips');

    }
    public function view_modal($id){
        $trip = Trip::findOrfail($id);
        $income = Transaction::where('trip_id', $id)->where('type', 'income')->with('created_by')->get();
        $expense = Transaction::where('trip_id', $id)->where('type', 'expense')->with('created_by')->get();
        return view('trips/view_modal', compact('trip', 'income', 'expense'));

    }
    public function view($id){
        $trip = Trip::with('ship')->with('transactions')->findOrfail($id);
        $meta = array(
            'page_title' => 'Trip ('.$trip->number.')',
            'active_page'=>'trips',
            'active_menu'=> 'trips',
            'bc'=> array(
                'Home' => url('/'),
                'Trips' => url('/trips'),
                'Trip ('.$trip->number.')'=>'active'
            ),
        );
        return view('trips.view_trip', compact('meta', 'trip'));
    }
}
