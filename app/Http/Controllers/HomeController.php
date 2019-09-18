<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $meta = array(
            'page_title' => 'Home',
            'active_page' => 'home',
            'active_menu' => 'home',
            'bc' => array(
                'Home' => 'active',
            ),
        );
        $total_trip = Trip::count();
        $total_income = Transaction::where('type','income')->sum('amount');
        $total_expense = Transaction::where('type','expense')->sum('amount');
        $total_profit = $total_income-$total_expense;
        $now = Carbon::now()->subMonth(11);
        $month_trip = array();
        $income = array();
        $expense = array();
        $trips_profit = array();
        for ($i=1; $i < 13; $i++){
            $month_trip[$now->format('Y-M')] = Trip::whereMonth('start_date', $now)->count();
            $trips_profit[] =  Trip::select(DB::raw('SUM((income - expense)) as profit'),DB::raw('MONTH(created_at) month'))
                ->whereMonth('start_date',$now)
            ->groupBy('month')->get();
            $income[] = Transaction::where('type','income')->whereMonth('created_at', $now)->sum('amount');
            $expense[] = Transaction::where('type','expense')->whereMonth('created_at', $now)->sum('amount');
            $now->addmonth();
        }
//        return $income;
        [$month, $trips] = Arr::divide($month_trip);
        $current_trip = Trip::where('status', '!=', 'completed')->with('ship')->get();
        return view('home', compact('meta', 'current_trip', 'total_trip', 'month','trips','trips_profit','income','expense','total_income','total_expense','total_profit'));
    }
}
