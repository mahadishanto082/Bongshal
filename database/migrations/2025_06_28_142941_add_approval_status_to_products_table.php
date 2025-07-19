<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderApprovalController extends Controller
{
    public function index()
    {
        // Fetch all products for approval
        $products = Product::all();

        return view('admin.products.approval', compact('products'));
    }

    public function approve(Product $product)
    {
        if ($product->approval_status === 'pending') {
            $product->update(['approval_status' => 'approved']);
            return redirect()->back()->with('success', 'Product approved.');
        }
        return redirect()->back()->with('error', 'Product already processed.');
    }

    public function reject(Product $product)
    {
        if ($product->approval_status === 'pending') {
            $product->update(['approval_status' => 'rejected']);
            return redirect()->back()->with('success', 'Product rejected.');
        }
        return redirect()->back()->with('error', 'Product already processed.');
    }
}
