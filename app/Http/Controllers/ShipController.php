<?php

namespace App\Http\Controllers;

use App\Ship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function ship_view(Request $request, $id){
        $loggedUser = Auth::user();
        if (!$loggedUser->can('ship_view'))
            abort(403);
        if ($request->filled('date_range')){
            $range_array = explode(' - ', $request->input('date_range'));
            $start = Carbon::createFromFormat('d F, Y', $range_array[0]);
            $end = Carbon::createFromFormat('d F, Y', $range_array[1]);
        }else{
            $end = Carbon::now();
            $start = $end->copy()->subDays(29);
        }
        $dates = collect();
        for ($date = $start->copy(); $date->lte($end);$date->addDay()){
            $dates->push(collect(['date' => $date->format('Y-m-d')]));
        }
        $ship = Ship::findOrFail($id);
        $tr_data=collect();
            foreach ($dates as $dt){
               $tr = $ship->transactions()->whereDate('.transactions.created_at', $dt['date'])->select(DB::raw('transactions.type'),DB::raw('SUM(transactions.amount) total'))->groupBy('transactions.type')->get();
                $income = $tr->where('type','income')->sum('total');
                $expense = $tr->where('type','expense')->sum('total');
                $tr_data->push(collect(['income' => $income, 'date'=>$dt['date'], 'expense'=>$expense, 'profit'=> $income-$expense ]));
            }
//        });
        $total_trip = $ship->trips()->whereBetween('start_date', [$start->format('Y-m-d'),$end->format('Y-m-d')])->count();
        $trans = $ship->transactions()->whereBetween('transactions.created_at', [$start->format('Y-m-d'),$end->format('Y-m-d')])->select(DB::raw('transactions.type'),DB::raw('SUM(transactions.amount) total'))->groupBy('.transactions.type')->get();
        $total_income = $trans->where('type','income')->sum('total');
        $total_expense = $trans->where('type','expense')->sum('total');
        $total_profit = $total_income-$total_expense;
        $meta = array(
            'page_title' => $ship->name,
            'active_page'=>$ship->name,
            'active_menu'=> $ship->name,
            'bc'=> array(
                'Home' => url('/'),
                $ship->name => 'active'
            ),
        );

        return view('ships.view', compact('meta', 'tr_data', 'ship', 'start', 'end', 'total_trip', 'total_income', 'total_expense', 'total_profit'));

    }
}
