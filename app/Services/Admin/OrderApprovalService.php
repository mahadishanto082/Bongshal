<?php
namespace App\Services;

use App\Models\OrderApproval;

class OrderApprovalService
{
    public function approve(OrderApproval $orderApproval, $approvedByUserId = null)
    {
        if ($orderApproval->status !== 'pending') {
            return ['success' => false, 'message' => 'Order already processed.'];
        }

        $orderApproval->update([
            'status' => 'approved',
            'approved_by' => $approvedByUserId,
        ]);

        // Additional logic: update order status, notify user, etc.

        return ['success' => true, 'message' => 'Order approved.'];
    }

    public function reject(OrderApproval $orderApproval, $approvedByUserId = null)
    {
        if ($orderApproval->status !== 'pending') {
            return ['success' => false, 'message' => 'Order already processed.'];
        }

        $orderApproval->update([
            'status' => 'rejected',
            'approved_by' => $approvedByUserId,
        ]);

        // Additional logic: update order status, notify user, etc.

        return ['success' => true, 'message' => 'Order rejected.'];
    }
}
