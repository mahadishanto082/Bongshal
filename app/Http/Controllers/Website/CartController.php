<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function view()
    {
        $data = $this->cartTotal();
        return view('website.cart', $data);
    }

    public function getAllCart()
    {
        return  response()->json([
            'status' => true,
            'data' => $this->cartTotal(),
        ]);
    }

    public function addToCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $qty = $request->qty ?? 1;
        if ($product->stock < $qty) {
            return  response()->json([
                'status' => false,
                'message' => "Too much quantity. We have not sufficient quantity",
            ]);
        }

        if ($product->discount_type && $product->discount_value > 0) {
            $dAmount = getDiscountAmount($product->price, $product->discount_type, $product->discount_value);
            $discountAmount = floor($dAmount);
        } else {
            $discountAmount = 0;
        }

        $price = floor($product->price);

        if ($product) {
            Cart::add([
                'id'        => $product->slug,
                'name'      => $product->name,
                'price'     => $price,
                'qty'       => $qty,
                'options' => [
                    'code'                 => $product->code,
                    'image'                => $product->image,
                    'product_size'         => $request->product_size,
                    'product_color'        => $request->product_color,
                    'product_fabrics'      => $request->product_fabrics,
                    'discount_type'        => $product->discount_type,
                    'discount_value'       => $product->discount_value,
                    'discount_amount'      => $discountAmount,
                ]
            ]);
//            Cart::tax(0);

            return  response()->json([
                'status' => true,
                'message' => "Product add to cart!",
            ]);

        } else {
            return  response()->json([
                'status' => false,
                'message' => "Product not found",
            ]);
        }
    }

    public function quickAddCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $qty = $request->qty ?? 1;
        if ($product->stock < $qty) {
            return  response()->json([
                'status' => false,
                'message' => "Too much quantity. We have not sufficient quantity",
            ]);
        }

        if ($product->discount_type && $product->discount_value > 0) {
            $dAmount = getDiscountAmount($product->price, $product->discount_type, $product->discount_value);
            $discountAmount = floor($dAmount);
        } else {
            $discountAmount = 0;
        }

        $price = floor($product->price);

        if ($product) {
            Cart::add([
                'id'        => $product->slug,
                'name'      => $product->name,
                'price'     => $price,
                'qty'       => $qty,
                'options' => [
                    'code'                 => $product->code,
                    'image'                => $product->image,
                    'product_size'         => $request->product_size,
                    'product_color'        => $request->product_color,
                    'product_fabrics'      => $request->product_fabrics,
                    'discount_type'        => $product->discount_type,
                    'discount_value'       => $product->discount_value,
                    'discount_amount'      => $discountAmount,
                ]
            ]);
//            Cart::tax(0);

            return redirect()->back()->with('success', 'Product add to cart!');

        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    public function updateCart(Request $request, $rowId)
    {
        $cart = Cart::get($rowId);
        $cartQty = (int)$cart->qty;

        if ($request->type == 'increment') {
            $cartQty = $cartQty + 1;
        } else {
            $cartQty = $cartQty - 1;
        }

        $product = Product::where('slug', $cart->id)->first();

        if ($product->stock < $cartQty) {
            return  response()->json([
                'status' => false,
                'message' => "Too much quantity. We have not sufficient quantity",
            ]);
        }

        Cart::update(
            $rowId, [
            'qty' => $cartQty,
            'options' => [
                'code'                 => $cart->options->code,
                'image'                => $cart->options->image,
                'product_size'         => $cart->options->product_size,
                'product_color'        => $cart->options->product_color,
                'product_fabrics'      => $cart->options->product_fabrics,
                'discount_type'        => $cart->options->discount_type,
                'discount_value'       => $cart->options->discount_value,
                'discount_amount'      => $cart->options->discount_amount,
            ]
        ]);
        return  response()->json([
            'status' => true,
            'message' => "Cart update successfully",
        ]);
    }

    public function removeCart($cartId)
    {
        Cart::remove($cartId);
        return  response()->json([
            'status' => true,
            'message' => "Cart remove successfully",
        ]);
    }

    public function destroyCart()
    {
        Cart::destroy();
        return  response()->json([
            'status' => true,
            'message' => "Cart destroy successfully",
        ]);
    }

    protected function cartTotal() {
        $cartData = Cart::content();
        $cartCountTotal = Cart::count();
        $subtotalAmount = Cart::subtotal();
        $totalDiscountAmount = 0;
        foreach ($cartData as $cart) {
            $totalDiscountAmount += ($cart->options->discount_amount * $cart->qty);
        }
        $totalAmount = Cart::total() - $totalDiscountAmount;

        $data = [
            'cart_content'          => $cartData,
            'cart_count_total'      => $cartCountTotal,
            'subtotal_amount'       => numberFormatBD($subtotalAmount, 2),
            'total_discount_amount' => numberFormatBD($totalDiscountAmount, 2),
            'total_amount'          => numberFormatBD($totalAmount, 2),
        ];

        return $data;
    }
}
