<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderApproval;

class OrderApprovalController extends Controller
{
    public function index()
    {
        // সব Pending বা যেই রিকুয়েস্টগুলো এসেছে
        $approvals = OrderApproval::with(['order', 'vendor'])->paginate(10);

        return view('admin.approval.index', compact('approvals'));
    }

    public function approve($id)
    {
        $approval = OrderApproval::findOrFail($id);
        if ($approval->status === 'pending') {
            $approval->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Order approved successfully.');
        }
        return redirect()->back()->with('error', 'Order already processed.');
    }

    public function reject($id)
    {
        $approval = OrderApproval::findOrFail($id);
        if ($approval->status === 'pending') {
            $approval->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Order rejected successfully.');
        }
        return redirect()->back()->with('error', 'Order already processed.');
    }
}
