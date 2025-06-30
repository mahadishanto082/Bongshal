<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderApproval;

class OrderApprovalController extends Controller
{
    public function create()
    {
        $orders = auth()->user()->orders()->where('status', 'pending')->get();
        return view('vendor.order_approval.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        OrderApproval::create([
            'order_id' => $request->order_id,
            'vendor_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Approval request sent.');
    }
}
