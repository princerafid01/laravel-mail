<?php

namespace App\Http\Controllers\Api;

use App\Notifications\GeneralNotification;
use App\Transaction;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth');
    }

    public function add(Request $request){
        $loggedUser = Auth::user();
        if (!$loggedUser->can(['income_add', 'expense_add']))
            abort(403);
        if ($request->isMethod('post')){
            Validator::make($request->all(), [
                'type'=>'required|string',
                'trip'=>'required_without:trip_id',
                'detail'=>'required|string',
                'amount'=>'required|numeric'
            ])->validate();
            $type = $request->input('type');
            if ($request->filled('trip_id')){
                $trip = Trip::findOrfail($request->input('trip_id'));
            }elseif($request->filled('trip')){
                $trip = Trip::where('number',$request->input('trip'))->first();
            }else{
                return response()->json([
                    'status' => 'error',
                    'notify' => [
                        'title' => 'Failed !',
                        'type' => 'error',
                        'message' => $type.' could not be added'
                    ]
                ]);
            }
            $tr = new Transaction;
            $tr->trip_id = $trip->id;
            $tr->type = $type;
            $tr->amount = $request->input('amount');
            $tr->user_id = $loggedUser->id;
            $tr->detail = $request->input('detail');
            if ($request->filled('date'))
                $tr->created_at = $request->input('date');
            $tr->save();
            update_trip($trip->id);
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification('A '.$tr->type.' has been added by '.$loggedUser->name, $tr->id, 'transaction'));
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Successful !',
                    'type' => 'success',
                    'message' => $type.' added'
                ]
            ]);
        }
    }

    public function getTransactions(Request $request){
        $loggedUser = Auth::user();
        if (!$loggedUser->can($request->input('type').'_view'))
            abort(403);
        $trans = Transaction::select('transactions.id','transactions.created_at','trips.number as trip','detail', 'amount','users.name as created_by')
        ->leftjoin('trips', 'transactions.trip_id', '=', 'trips.id')
        ->join('users', 'transactions.user_id', '=', 'users.id');
        if (!$loggedUser->can('view_all')){
            $trans =  $trans->where('user_id', $loggedUser->id);
        }
        if ($request->filled('type')){
            $trans =  $trans->where('transactions.type', $request->input('type'));
        }
        $trans = $trans->orderBy('transactions.created_at', 'desc')->get();
        return $trans;

    }
    public function view($id){
        $loggedUser = Auth::user();
        $tr = Transaction::with('trip')->with('created_by')->findOrfail($id);
        if (!$loggedUser->can($tr->type.'_view'))
            abort(403);
        return $tr;
    }
    public function update(Request $request, $id){
        $loggedUser = Auth::user();
        $tr = Transaction::findOrfail($id);
        if (!$loggedUser->can($tr->type.'_edit'))
            abort(403);
        Validator::make($request->all(), [
            'detail'=>'required',
            'amount'=>'required|numeric'
        ])->validate();

        $tr->detail = $request->input('detail');
        $tr->amount = $request->input('amount');
        $tr->created_at = $request->input('date');
        $tr->save();
        if ($tr->trip_id)
        update_trip($tr->trip_id);
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        Notification::send($users, new GeneralNotification('A '.$tr->type.' has been edited by '.$loggedUser->name, $tr->id, 'transaction'));
        return response()->json([
            'status' => 'success',
            'notify' => [
                'title' => 'Successful !',
                'type' => 'success',
                'message' => ' Transaction updated'
            ]
        ]);
    }
    public function delete($id){
        $loggedUser = Auth::user();
        $tr = Transaction::findOrfail($id);
        if (!$loggedUser->can($tr->type.'_delete'))
            abort(403);
        $tr->delete();
        if ($tr->trip_id)
        update_trip($tr->trip_id);
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        if ($tr->trip_id){
            Notification::send($users, new GeneralNotification('An '.$tr->type.'('.$tr->amount.' Tk.) of '.$tr->trip->number.' has been deleted by '.$loggedUser->name, $tr->trip->id, 'trip'));
        }else{
            Notification::send($users, new GeneralNotification('A general expense('.$tr->amount.' Tk.) has been deleted by '.$loggedUser->name));
        }
        return response()->json([
            'status' => 'success',
            'notify' => [
                'title' => 'Successful !',
                'type' => 'success',
                'message' => ' Transaction deleted'
            ]
        ]);
    }
    public function addGexpense(Request $request){
        $loggedUser = Auth::user();
        if (!$loggedUser->can(['gexpense_add']))
            abort(403);
        Validator::make($request->all(), [
            'type'=>'required|string',
            'detail' =>'required|string',
            'amount'=>'required|numeric'
        ])->validate();
        $tr = new Transaction;
        $tr->type = 'gexpense';
        $tr->amount = $request->input('amount');
        $tr->user_id = $loggedUser->id;
        $tr->detail = $request->input('detail');
        if ($request->filled('date'))
            $tr->created_at = $request->input('date');
        $tr->save();
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        Notification::send($users, new GeneralNotification('A general expense has been added by '.$loggedUser->name, $tr->id, 'transaction'));
        return response()->json([
            'status' => 'success',
            'notify' => [
                'title' => 'Successful !',
                'type' => 'success',
                'message' => ' General expense added.'
            ]
        ]);
    }
    public function getMonthlyGexpense(){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('gexpense_view'))
            abort(403);
        $data = array();
        $start = Carbon::createFromFormat('Y-m-d','2019-06-01');
        $end = Carbon::today();
        $diff = $start->diffInMonths($end)+1;
        for ($i=1;$i<=$diff;$i++){
            $trs = Transaction::select('transactions.id','transactions.created_at','trips.number as trip','detail', 'amount','users.name as created_by')
                ->leftjoin('trips', 'transactions.trip_id', '=', 'trips.id')
                ->join('users', 'transactions.user_id', '=', 'users.id')
                ->where('transactions.type', 'gexpense')
                ->whereMonth('transactions.created_at', $end);
            if (!$loggedUser->can('view_all')){
                $trans =  $trs->where('user_id', $loggedUser->id);
            }
            $trs = $trs->orderBy('transactions.created_at', 'desc')->get();
            $m['expenses'] = $trs;
            $m['month']=$end->format('M-Y');
            $m['total']=$trs->sum('amount');
            $data[] = $m;
            $end->subMonth();
        }
        return $data;
    }
}
