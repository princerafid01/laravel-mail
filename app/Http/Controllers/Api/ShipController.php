<?php

namespace App\Http\Controllers\Api;

use App\Ship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShipController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth');
    }

    public function getData(Request $request, $id){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('ship_view'))
            abort(403);
        if ($request->filled('start_date') && $request->filled('end_date')){
//            $range_array = explode(' - ', $request->input('date_range'));
            $start = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
            $end = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        }else{
            $end = Carbon::now();
            $start = new Carbon('first day of July');
        }
        $dates = array();
        for ($date = $start->copy(); $date->lte($end);$date->addDay()){
            $dates[] = $date->format('Y-m-d');
        }
        $ship = Ship::findOrFail($id);
        $income = array();
        $expense = array();
        $profit = array();
        foreach ($dates as $dt){
            $tr = $ship->transactions()->whereDate('.transactions.created_at', $dt)->select(DB::raw('transactions.type'),DB::raw('SUM(transactions.amount) total'))->groupBy('transactions.type')->get();
            $income[] = $ti = $tr->where('type','income')->sum('total');
            $expense[] = $te =$tr->where('type','expense')->sum('total');
            $profit[] = $ti-$te;
        }
        $total_trip = $ship->trips()->whereBetween('start_date', [$start->format('Y-m-d'),$end->format('Y-m-d')])->count();
        $trans = $ship->transactions()->whereBetween('transactions.created_at', [$start->format('Y-m-d'),$end->format('Y-m-d')])->select(DB::raw('transactions.type'),DB::raw('SUM(transactions.amount) total'))->groupBy('.transactions.type')->get();
        $total_income = $trans->where('type','income')->sum('total');
        $total_expense = $trans->where('type','expense')->sum('total');
        $total_profit = $total_income-$total_expense;
        return response()->json([
            'chart_data' => [
                ['name'=>'Income', 'data'=> $income],
                ['name'=>'Expense', 'data'=> $expense],
                ['name'=>'Profit', 'data'=> $profit],
            ],
            'dates'=>$dates,
            'totalTrip'=>$total_trip,
            'totalIncome'=>$total_income,
            'totalExpense'=>$total_expense,
            'totalProfit'=>$total_profit,
            'start_date'=>$start->format('Y-m-d'),
            'end_date'=>$end->format('Y-m-d'),
        ]);
    }
}
