<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserPoint;
use App\Services\UserPointService;

class OrderService
{
    /**
     * Display a listing of the resource.
     */
    public function index($request)
    {
        try {
            $sql = Order::latest();
            if ($request->status) {
                $sql->where('status', $request->status);
            }

            $data['orders'] = $sql->paginate(20);

            return ['success' => true, 'data' => $data];
        } catch (\Exception $exception) {
            \Log::error('Order fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while fetching order. Please try again.'];
        }
    }

    /**
     * Update the specified resource.
     */
    public function update(array $data, $order)
    {
        try {
            $order->update($data);
            if ($order->status == 'Delivered' && $order->orderDetails) {
                foreach ($order->orderDetails as $detail) {
                    $product = Product::find($detail->product_id);
                    if ($product) {
                        $product->update([
                            'stock' => $product->stock - $detail->final_quantity
                        ]);
                        $userPoint = new UserPointService();
                        $userPoint->updateUserPoint($detail->id);
                    }
                }
            }
            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Order update failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while updating order. Please try again.'];
        }
    }
}
