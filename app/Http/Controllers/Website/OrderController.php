<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly OrderService $orderService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->orderService->index();

        if ($result['success']) {
            return view('website.checkout', $result['data']);
        } else {
            return redirect()->back()->withError($result['message']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        if (Cart::count() == 0) {
            return redirect()
                ->back()
                ->withError('Your Cart is empty. Please add product to cart to purchase them.');
        }

        $result = $this->orderService->store($request->validated());

        if ($result['success']) {
            return redirect(route('web.orderCompleted', $result['order']->id))
                ->withSuccess('Order placed successfully. We will contact very soon.');
        } else {
            return redirect()->back()->withError($result['message']);
        }
    }

    public function orderCompleted($orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            return view('website.order-complete', compact('order'));
        } else {
            return redirect()
                ->route('web.home')
                ->withError('Something went wrong. Please try again.');
        }
    }

    /**
     * Track a specified order.
     */
    public function trackOrder(Order $order)
    {
        $order = Order::with('orderDetails.product', 'shippingAddress', 'billingAddress')
            ->find($order->id);

        return view('website.user.order-tracking', ['order' => $order]);
    }

    public function trackCheck(Request $request)
    {
        $order = Order::find($request->order_number);
        if ($order) {
            return redirect(route('web.orders.track', $order->uuid));
        } else {
            return redirect()->back()->withError('Something went wrong. Your order number is invalid. Please try again.');
        }
    }
}
