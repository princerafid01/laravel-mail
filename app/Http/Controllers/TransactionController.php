<?php

namespace App\Http\Controllers;

use App\Notifications\GeneralNotification;
use App\Transaction;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function income(){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('income_view'))
            abort(403);
        $data = collect();
        $number = Trip::select('number')->chunk(200, function ($number) use ($data){
            foreach ($number as $n){
//                echo $n;
                $data->put($n->number, null);
            }
        });
        $meta = array(
            'page_title' => 'Income',
            'active_page'=>'income',
            'active_menu'=> 'income',
            'bc'=> array(
                'Home' => url('/'),
                'Income' => 'active'
            ),
        );
        return view('transaction.income', compact('meta', 'data'));
    }
    public function getTransactionList(Request $request){
        $loggedUser = Auth::user();
        $date_format = option('date_format');
        if (!$loggedUser->can(['income_view', 'expense_view']))
            abort(403);
        $tr = Transaction::with('trip')->with('created_by');
        if ($request->filled('type')){
            if (!$loggedUser->can($request->type.'_view'))
                abort(403);
            $tr = $tr->where('type', $request->input('type'));
        }
        if (!$loggedUser->can('view_all'))
            $tr = $tr->where('user_id', $loggedUser->id);
        if ($request->filled('start_date1') && !$request->filled('start_date2')){
            $tr = $tr->whereDate('created_at', Carbon::createFromFormat('Y-m-d',$request->input('start_date1')));
        }elseif ($request->filled('start_date1') && $request->filled('start_date2')){
            $tr = $tr->whereBetween('created_at', [$request->input('start_date1'), $request->input('start_date2')]);
        }
        if ($request->filled('income1') && !$request->filled('income2')){
            $tr = $tr->where('amount', $request->input('income1'));
        }elseif ($request->filled('income1') && $request->filled('income2')){
            $tr = $tr->whereBetween('amount', [$request->input('income1'), $request->input('income2')]);
        }
        if ($request->filled('trip')){
            $trip = $request->input('trip');
            $tr = $tr->whereHas('trip', function ($query) use ($trip){
                $query->where('number', 'like', '%'.$trip.'%');
            });
        }
        $tr->orderBy('created_at', 'desc')->get();
        return datatables()->of($tr)
            ->editColumn('created_at', function ($d) use ($date_format){
                return date($date_format, strtotime($d->created_at));
            })
            ->toJson();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function add(Request $request){
        $loggedUser = Auth::user();
        $date_format = option('date_format');
        if (!$loggedUser->can(['income_add', 'expense_add']))
            abort(403);
        if ($request->isMethod('post')){
            Validator::make($request->all(), [
                'type'=>'required|string',
                'trip'=>'required_without:trip_id',
                'amount'=>'required|numeric'
            ])->validate();
            $type = $request->input('type');
            if ($request->filled('trip_id')){
                $trip = Trip::findOrfail($request->input('trip_id'));
            }elseif($request->filled('trip')){
                $trip = Trip::where('number',$request->input('trip'))->first();
            }else{
                session()->flash('error', $type.' could not be added');
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
            Notification::send($users, new GeneralNotification('A '.$tr->type.' has been added by '.$loggedUser->name, route('transactionModal', ['id'=>$tr->id]), 'remote'));
            $request->session()->flash('success', $type.' added');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $type = $request->filled('type')? $request->input('type'):null;
        $data = collect();
        if ($request->filled('trip')){
            $trip = $request->input('trip');
        }else{
            $trip = null;
            $number = Trip::select('number')->chunk(200, function ($number) use ($data){
                foreach ($number as $n){
                    $data->put($n->number, null);
                }
            });
        }
        return view('transaction.add', compact('trip','type','data'));
    }
    public function edit(Request $request, $id){
        $tr = Transaction::findOrfail($id);
        $loggedUser = Auth::user();
        if (!$loggedUser->can($tr->type.'_edit'))
            abort(403);
        if ($request->isMethod('post')){
            $tr->detail = $request->input('detail');
            $tr->amount = $request->input('amount');
            $tr->created_at = $request->input('date');
            $tr->save();
            $request->session()->flash('success', $tr->type.' updated');
            update_trip($tr->trip_id);
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification('A '.$tr->type.' has been edited by '.$loggedUser->name, route('transactionModal', ['id'=>$tr->id]), 'remote'));
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $meta = array(
            'page_title' => Str::title($tr->type),
            'active_page'=>$tr->type,
            'active_menu'=> $tr->type,
            'bc'=> array(
                'Home' => url('/'),
                Str::title($tr->type) => url('/'.$tr->type),
                'Edit '.$tr->type => 'active'
            ),
        );
        return view('transaction.edit', compact('meta', 'tr'));
    }
    public function delete($id){
        $tr = Transaction::with('trip')->findOrfail($id);
        $loggedUser = Auth::user();
        if (!$loggedUser->can($tr->type.'_delete'))
            abort(403);
        $tr->delete();
        update_trip($tr->trip_id);
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        Notification::send($users, new GeneralNotification('An '.$tr->type.'('.$tr->amount.' Tk.) of '.$tr->trip->number.' has been deleted by '.$loggedUser->name, route('TripViewModal', ['id'=>$tr->trip->id]), 'remote_b'));
        session()->flash('success', $tr->type.' deleted.');
        return redirect(url($tr->type));
    }
    public function expense(){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('expense_view'))
            abort(403);
        $data = collect();
        $number = Trip::select('number')->chunk(200, function ($number) use ($data){
            foreach ($number as $n){
                $data->put($n->number, null);
            }
        });
        $meta = array(
            'page_title' => 'Expense',
            'active_page'=>'expense',
            'active_menu'=> 'expense',
            'bc'=> array(
                'Home' => url('/'),
                'Expense' => 'active'
            ),
        );
        return view('transaction.expense', compact('meta', 'data'));
    }
    public function view_modal($id){
      $tr = Transaction::with('trip')->with('created_by')->find($id);
      if ($tr){
          return view('transaction.modal', compact('tr'));
      }
    }
}
