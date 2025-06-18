<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $data['todayOrders'] = Order::whereDate('created_at', Carbon::today())
            ->count();
        $data['totalOrders'] = Order::count();
        $data['todaySales'] = Order::whereDate('created_at', Carbon::today())
            ->sum('final_total');
        $data['totalSales'] = Order::sum('final_total');

        return view('admin.home', $data);
    }
}
