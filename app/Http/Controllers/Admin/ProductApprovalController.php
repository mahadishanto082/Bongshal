<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderApproval;   
use App\Models\ProductApproval; // Assuming you have a ProductApproval model

class ProductApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');  // শুধু অ্যাডমিন লগইন থাকলে কাজ করবে
    }

    /**
     * Pending প্রোডাক্ট গুলো দেখাবে
     */
    public function index()
{
    $approvals = Product::with('vendor')  // Assuming Product has vendor relationship
                    ->where('approval_status', 'pending')
                    ->paginate(10);

    return view('admin.approval.index', compact('approvals'));
}


    /**
     * প্রোডাক্ট Approve করবে
     */
    public function approve(Product $product)
    {
        if ($product->approval_status === 'pending') {
            
            $product->update(['approval_status' => 'approved']);

            return redirect()->back()->with('success', 'Product approved successfully.');
        }

        return redirect()->back()->with('error', 'Product already processed.');
    }

    /**
     * প্রোডাক্ট Reject করবে
     */
    public function reject(Product $product)
    {
        if ($product->approval_status === 'pending') {
            $product->update(['approval_status' => 'rejected']);
            return redirect()->back()->with('success', 'Product rejected successfully.');
        }

        return redirect()->back()->with('error', 'Product already processed.');
    }
}
