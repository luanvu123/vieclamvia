<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


public function index()
{
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $salesData = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $chartData = [];
    $totalRevenue = 0;
    $totalProfit = 0;

    foreach ($salesData as $data) {
        $dailyRevenue = (float) $data->revenue;
        $dailyProfit = round($dailyRevenue * 0.3, 2); // Lợi nhuận là 30% doanh thu

        $totalRevenue += $dailyRevenue;
        $totalProfit += $dailyProfit;

        $chartData[] = [
            'date' => $data->date,
            'revenue' => $dailyRevenue,
            'profit' => $dailyProfit,
        ];
    }

    return view('home', compact('chartData', 'totalRevenue', 'totalProfit'));
}

}
