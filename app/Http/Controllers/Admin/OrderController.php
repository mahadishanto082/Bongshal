<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * The OrderService instance.
     *
     * @var OrderService $orderService
     */
    private OrderService $orderService;

    /**
     * Create a new controller instance.
     *
     * @param void
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = $this->orderService->index($request);

        if ($result['success']) {
            return view('admin.orders.index', $result['data']);
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = Order::with('orderDetails.product', 'shippingAddress', 'billingAddress', 'refAgent')
            ->find($order->id);

        return view('admin.orders.show', ['order' => $order]);
    }


    /**
     * Update the specified resource.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => ['required', 'in:Pending,"In Progress","Ready to Ship",Shipped,Delivered,Returned,Canceled,Failed']
        ]);

        $result = $this->orderService->update($validatedData, $order);

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Order status updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();

            return redirect()->back()->with('success', 'Order delete successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
