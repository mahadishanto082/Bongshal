<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserPointService
{
    public function earnPoint($productId, $orderDetailsId, $qty, $note, $user)
    {
        $product = Product::find($productId);
        if ($user && $product->point > 0) {
            UserPoint::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'order_details_id' => $orderDetailsId,
                'point' => ($product->point * $qty),
                'flag' => "Earn",
                'notes' => $note,
            ]);
        }

    }

    public function updateUserPoint($orderDetailsId)
    {
        $userPoints = UserPoint::where('order_details_id', $orderDetailsId)->where('status', 'Pending')->get();

        if (count($userPoints) > 0) {
            foreach ($userPoints as $up) {
                $user = User::where('role', 'Agent')->find($up->user_id);
                $up->update([
                    'status' => 'Complete'
                ]);
                $user->update([
                    'point' => $user->point + $up->point
                ]);
            }
        }

    }
}
