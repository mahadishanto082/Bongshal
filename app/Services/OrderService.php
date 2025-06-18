<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $setting = getSetting();
            $user = auth('web')->user();
            if ($user) {
                $addresses = UserAddress::where(['user_id' => $user->id, 'is_default' => 1])
                    ->whereIn('address_type', ['shipping', 'billing'])
                    ->get();
                $data['shippingAddress'] = $addresses->where('address_type', 'shipping')->first();
                $data['billingAddress'] = $addresses->where('address_type', 'billing')->first();
            } else {
                $data['shippingAddress'] = '';
                $data['billingAddress'] = '';
            }

            if ($setting && $setting->shipping_in_dhaka) {
                $data['insideDhakaShipping'] = $setting->shipping_in_dhaka;
            } else {
                $data['insideDhakaShipping'] = 80;
            }

            if ($setting && $setting->shipping_out_dhaka) {
                $data['outsideDhakaShipping'] = $setting->shipping_out_dhaka;
            } else {
                $data['outsideDhakaShipping'] = 130;
            }

            return ['success' => true, 'data' => $data];
        } catch (\Exception $exception) {
            \Log::error('Address fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while fetching addresses. Please try again.'];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        try {
            // DB transaction begins
            \DB::beginTransaction();

            $cartData = Cart::content();

            // Calculate shipping charge
            list($total_shipping_charge, $agent) = $this->calculateShippingCharge($data);

            // Create the order
            $order = Order::create([
                'sub_total' => 0,
                'discount' => 0,
                'total' => 0,
                'total_shipping_charge' => $total_shipping_charge,
                'final_total' => 0,
                'user_id' => auth()->id() ?? null,
                'ref_agent_id' => $agent ? $agent->id : null,
            ]);

            $updateOrderData = [
                'sub_total' => 0,
                'discount' => 0,
                'total' => 0,
                'final_total' => 0,
            ];

            // Create order details
            $this->storeOrderDetails($cartData, $updateOrderData, $order);

            // Create shipping and billing address
            $this->storeAddress($data, $order);

            // Create transaction
            $this->storeTransaction($data, $order);

            // DB Transaction completed
            \DB::commit();

            Cart::destroy();

            return ['success' => true, 'order' => $order];
        } catch (\Exception $exception) {
            \Log::error('Order creation failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while placing the order. Please try again.'];
        }
    }

    /**
     * Calculate shipping charge.
     */
    public function calculateShippingCharge($data)
    {
        $setting = getSetting();

        if ($setting && $setting->shipping_in_dhaka) {
            $insideDhakaShipping = $setting->shipping_in_dhaka;
        } else {
            $insideDhakaShipping = 80;
        }

        if ($setting && $setting->shipping_out_dhaka) {
            $outsideDhakaShipping = $setting->shipping_out_dhaka;
        } else {
            $outsideDhakaShipping = 130;
        }

        $ref = Str::upper($data['reference_code']);
        $agent = User::where('reference', $ref)->where('role', 'Agent')
            ->where('status', 'Active')
            ->first();

        $authAgent = Auth::guard('web')->user();

        if ($agent) {
            $total_shipping_charge = 0;
        } elseif (Auth::guard('web')->check() && $authAgent->role == 'Agent') {
            $total_shipping_charge = 0;
        } else {
            $total_shipping_charge = $data['shipping'] == 'Inside dhaka' ? $insideDhakaShipping : $outsideDhakaShipping;
        }
        return [
            $total_shipping_charge,
            $agent,
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOrderDetails($cartData, $updateOrderData, $order)
    {
        foreach ($cartData as $cart) {
            $product = Product::where('slug', $cart->id)->first();
            $qty = $cart->qty;

            if ($product->stock < $qty) {
                return  redirect()->back()->withError('Too much quantity. We have not sufficient quantity');
            }

            $discount = $product->discount_type == 'Taka' ? $product->discount_value : ($product->price * $product->discount_value) / 100;
            $subTotal = $qty * $product->price;
            $total = $subTotal - ($discount * $qty);
            $updateOrderData['sub_total'] += $subTotal;
            $updateOrderData['discount'] += $discount * $qty;

            $od = OrderDetail::create([
                'product_name' => $product->name,
                'product_unit_price' => $product->price,
                'product_buy_price' => $product->buy_price,
                'discount' => $discount,
                'product_quantity' => $qty,
                'final_quantity' => $qty,
                'sub_total' => $subTotal,
                'total' => $total,
                'final_total' => $total,
                'product_id' => $product->id,
                'product_color' => $cart->options->product_color,
                'product_size' => $cart->options->product_size,
                'product_fabrics' => $cart->options->product_fabrics,
                'order_id' => $order->id,
            ]);

            // Update order
            $updateOrderData['total'] = ($updateOrderData['sub_total'] + $order->total_shipping_charge) - $updateOrderData['discount'];
            $updateOrderData['final_total'] = $updateOrderData['total'];
            $order->update($updateOrderData);

            if (auth('web')->check()) {
                $user = auth('web')->user();
                if ($user->role == 'Agent') {
                    $pointService = new UserPointService();
                    $pointService->earnPoint($product->id, $od->id, $od->product_quantity, 'Buy Product', $user);
                }
            }

            if ($order->ref_agent_id) {
                $user = User::find($order->ref_agent_id);
                $pointService = new UserPointService();
                $pointService->earnPoint($product->id, $od->id, $od->product_quantity, 'Reference Buy Product', $user);
            }
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAddress($data, $order)
    {
        $shippingData = [
            'name' => $data['shipping_name'],
            'email' => $data['shipping_email'],
            'address_type' => 'shipping',
            'address_line' => $data['shipping_address_line'],
            'district' => $data['shipping_district'] ?? null,
            'phone' => $data['shipping_phone'],
            'order_id' => $order->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (array_key_exists('same_as_shipping', $data)) {
            $billingData = array_replace($shippingData, ['address_type' => 'billing']);
        } else {
            $billingData = [
                'name' => $data['billing_name'],
                'email' => $data['billing_email'],
                'address_type' => 'billing',
                'address_line' => $data['billing_address_line'],
                'district' => $data['billing_district'] ?? null,
                'phone' => $data['billing_phone'],
                'order_id' => $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        OrderAddress::insert([
            $shippingData,
            $billingData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTransaction($data, $order)
    {
        Transaction::create([
            'type' => $data['transaction_type'],
            'amount' => $order->final_total,
            'order_id' => $order->id,
        ]);
    }
}
