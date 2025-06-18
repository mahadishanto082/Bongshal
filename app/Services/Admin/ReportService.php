<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class ReportService
{
    /**
     * Display a listing of the resource.
     */
    public function orders(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');

            $items = Order::select(
                    \DB::raw('COUNT(id) AS totalOrderNumber'),
                    \DB::raw('SUM(final_total) AS totalOrderAmount'),
                    \DB::raw('DATE(created_at) AS date')
                )
                ->where('status', 'Delivered')
                ->whereYear('created_at', $year)
                ->groupBy(\DB::raw('DATE(created_at)'))
                ->get();

            $data = [];
            foreach ($items as $item) {
                $dateArr = explode('-', $item->date);

                if (!$request->query('report_type') || $request->query('report_type') == 'order_amount') {
                    $data[intVal($dateArr[1])][intVal($dateArr[2])] = $item->totalOrderAmount;
                } else {
                    $data[intVal($dateArr[1])][intVal($dateArr[2])] = $item->totalOrderNumber;
                }
            }

            return ['success' => true, 'data' => ['orders' => $data]];
        } catch (\Exception $exception) {
            \Log::error('Order report fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while fetching order report. Please try again.'];
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function ledger(Request $request)
    {
        try {
            $month = $request->month ?? date('m');
            $year = $request->year ?? date('Y');

            $data = OrderDetail::select('order_details.*', 'orders.status')
                ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
                ->whereMonth('order_details.created_at', $month)
                ->whereYear('order_details.created_at', $year)
                ->where('orders.status', 'Delivered')
                ->get();

            return ['success' => true, 'data' => ['orderDetails' => $data]];
        } catch (\Exception $exception) {
            \Log::error('Order ledger fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while fetching ledger. Please try again.'];
        }
    }
}
