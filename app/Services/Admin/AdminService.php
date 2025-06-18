<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    /**
     * Update user's profile.
     */
    public function profileUpdate(array $data)
    {
        try {
            $admin = auth('admin')->user();

            if (array_key_exists('image', $data) && $data['image']) {
                if ($admin->image) Storage::disk('public')->delete($admin->image);
                $data['image'] = request()->file('image')->store('admin', ['disk' => 'public']);
            }

            $admin->update($data);

            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Profile update failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while updating the profile. Please try again.'];
        }
    }

    /**
     * Update admins password.
     */
    public function passwordUpdate(array $data)
    {
        $admin = auth('admin')->user();

        if (!Hash::check($data['password'], $admin->password)) {
            return ['success' => false, 'message' => 'Password is incorrect.'];
        }

        $admin->update(['password' => Hash::make($data['new_password'])]);

        return ['success' => true];
    }

    /**
     * Update admins email.
     */
    public function emailUpdate(array $data)
    {
        $admin = auth('admin')->user();

        if ($data['email'] != $admin->email) {
            return ['success' => false, 'message' => 'Email is incorrect.'];
        }

        $admin->update(['email' => $data['new_email']]);

        return ['success' => true];
    }
}
