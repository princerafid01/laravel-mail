<?php

namespace App\Http\Controllers\api;

use App\Transaction;
use App\Trip;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth');
    }
    public function index(Request $request){
        if ($request->filled('start_date') && $request->filled('end_date')){
            $start = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
            $end = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        }else{
            $end = Carbon::now();
            $start = new Carbon('first day of July');
        }
        $total_trip = Trip::whereBetween('start_date', [$start->format('Y-m-d'),$end->format('Y-m-d')])->count();
        $total_income = Transaction::whereBetween('created_at', [$start->format('Y-m-d'),$end->format('Y-m-d')])->where('type','income')->sum('amount');
        $total_expense = Transaction::whereBetween('created_at', [$start->format('Y-m-d'),$end->format('Y-m-d')])->where('type','expense')->sum('amount');
        $total_gexpense = Transaction::whereBetween('created_at', [$start->format('Y-m-d'),$end->format('Y-m-d')])->where('type','gexpense')->sum('amount');
        $total_profit = $total_income-$total_expense;
        $current_trip = Trip::where('status', '!=', 'completed')->with('ship')->get();
        return response()->json([
            'total_trip' => $total_trip,
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'total_profit' => $total_profit,
            'current_trip' => $current_trip,
            'total_gexpense' => $total_gexpense,
            'start_date'=>$start->format('Y-m-d'),
            'end_date'=>$end->format('Y-m-d'),
        ]);
    }
}
