<?php

namespace App\Http\Controllers;

use App\Notifications\GeneralNotification;
use App\Transaction;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index(){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('gexpense_view'))
            abort(403);
        $data = array();
        $start = Carbon::createFromFormat('Y-m-d H:i:s','2019-06-01 00:00:00');
        $end = Carbon::today();
        $diff = $start->diffInMonths($end)+1;
        $months=array();
        for ($i=1;$i<=$diff;$i++){
            $m['total'] = Transaction::where('type', 'gexpense')->whereMonth('created_at', $end)->sum('amount');
            $m['month']=$end->format('M-Y');
            $months[] = $m;
            $end->subMonth();
        }
        $meta = array(
            'page_title' => 'General expense',
            'active_page'=>'gexpense',
            'active_menu'=> 'gexpense',
            'bc'=> array(
                'Home' => url('/'),
                'General expense' => 'active'
            ),
        );
        return view('expense.index', compact('meta', 'data','color','months','tables'));
    }
    public function getExpenseList(Request $request){
        $loggedUser = Auth::user();
        $date_format = option('date_format');
        if (!$loggedUser->can('gexpense_view'))
            abort(403);
        $tr = Transaction::where('type','gexpense')->with('created_by');
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
        if ($request->filled('month')){
            $m = Carbon::createFromFormat('M-Y', $request->input('month'));
            $tr = $tr->whereMonth('created_at', $m);
        }
        $tr->orderBy('created_at', 'desc')->get();
        return datatables()->of($tr)
            ->editColumn('created_at', function ($d) use ($date_format){
                return date($date_format, strtotime($d->created_at));
            })
            ->toJson();
    }

    public function add(Request $request){
        $loggedUser = Auth::user();
        $date_format = option('date_format');
        if (!$loggedUser->can('gexpense_add'))
            abort(403);
        if ($request->isMethod('post')){
            Validator::make($request->all(), [
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
            Notification::send($users, new GeneralNotification('A general expense has been added by '.$loggedUser->name, route('expenseModal', ['id'=>$tr->id]), 'remote'));
            $request->session()->flash('success', 'Expense added');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return view('expense.add', compact('trip','type','data'));
    }
    public function edit(Request $request, $id){
        $tr = Transaction::findOrfail($id);
        $loggedUser = Auth::user();
        if (!$loggedUser->can('gexpense_edit'))
            abort(403);
        if ($request->isMethod('post')){
            $tr->detail = $request->input('detail');
            $tr->amount = $request->input('amount');
            $tr->created_at = $request->input('date');
            $tr->save();
            $request->session()->flash('success', $tr->type.' updated');
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification('A general expense has been edited by '.$loggedUser->name, route('expenseModal', ['id'=>$tr->id]), 'remote'));
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $meta = array(
            'page_title' => Str::title($tr->type),
            'active_page'=>$tr->type,
            'active_menu'=> $tr->type,
            'bc'=> array(
                'Home' => url('/'),
                'Edit '.$tr->type => 'active'
            ),
        );
        return view('expense.edit', compact('meta', 'tr'));
    }
    public function delete($id){
        $tr = Transaction::findOrfail($id);
        $loggedUser = Auth::user();
        if (!$loggedUser->can('gexpense_delete'))
            abort(403);
        $tr->delete();
        $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
        Notification::send($users, new GeneralNotification('A general expense('.$tr->amount.' Tk.) has been deleted by '.$loggedUser->name));
        session()->flash('success', $tr->type.' deleted.');
        return redirect(url($tr->type));
    }
    public function view_modal($id){
        $tr = Transaction::with('trip')->with('created_by')->find($id);
        if ($tr){
            return view('expense.modal', compact('tr'));
        }
    }
    public function printView(Request $request){
        if ($request->filled('month')){
            $month = Carbon::createFromFormat('M-Y', $request->input('month'));
        }else{
            $month = Carbon::today();
        }

        $tr = Transaction::where('type', 'gexpense')->whereMonth('created_at', $month)->with('created_by')->orderBy('created_at', 'asc')->get();
        $meta = array(
            'page_title' => 'Print General expense',
            'active_page'=>'gexpense',
            'active_menu'=> 'gexepnse',
            'bc'=> array(
                'Home' => url('/'),
                'General Expense' => url('/gexpense'),
                'Print' => 'active'
            ),
        );
        return view('expense.print', compact('meta', 'tr', 'month'));
    }
}
