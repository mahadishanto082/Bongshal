<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Update user's password.
     */
    public function orders()
    {
        try {
            $data['orders'] = auth('web')->user()
                ->orders()
                ->with('orderDetails.product.category')
                ->latest()
                ->paginate();

            return ['success' => true, 'data' => $data];
        } catch (\Exception $exception) {
            \Log::error('Order fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while fetching orders. Please try again.'];
        }
    }

    /**
     * Update user's password.
     */
    public function passwordUpdate(array $data)
    {
        $user = auth('web')->user();

        if (!Hash::check($data['password'], $user->password)) {
            return ['success' => false, 'message' => 'Password is incorrect.'];
        }

        $user->update(['password' => Hash::make($data['new_password'])]);

        return ['success' => true];
    }

    /**
     * Update user's profile.
     */
    public function profileUpdate(array $data)
    {
        try {
            $user = auth('web')->user();
            if (array_key_exists('image', $data) && $data['image']) {
                if ($user->image) Storage::disk('public')->delete($user->image);
                $data['image'] = request()->file('image')->store('user', ['disk' => 'public']);
            }
            $user->update($data);

            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Profile update failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while updating the profile. Please try again.'];
        }
    }

    /**
     * Cancel user's order.
     */
    public function cancelOrder(Order $order)
    {
        try {
            if (in_array($order->status, ['Pending', 'In Progress', 'Ready to Ship'])) {
                $order->update([
                    'status' => 'Canceled'
                ]);

                return ['success' => true];
            }

            return ['success' => false, 'message' => "Can't cancel order which is in $order->status. Please contact admin."];
        } catch (\Exception $exception) {
            \Log::error('Order cancel failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while canceling the order. Please try again.'];
        }
    }
}
