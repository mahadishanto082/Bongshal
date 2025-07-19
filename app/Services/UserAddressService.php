<?php

namespace App\Services;

use App\Models\UserAddress;

class UserAddressService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = UserAddress::where('user_id', auth('web')->id())->latest()->get();

            return ['success' => true, 'data' => $data];
        } catch (\Exception $exception) {
            \Log::error('Address fetch failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while getting addresses. Please try again.'];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        try {
            $data['user_id'] = auth('web')->id();
            $userAddress = UserAddress::create($data);

            if (array_key_exists('is_default', $data)) {
                UserAddress::where('address_type', $data['address_type'])
                    ->where('id', '!=', $userAddress->id)
                    ->update(['is_default' => 0]);
            }

            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Address creation failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while creating the address. Please try again.'];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, UserAddress $userAddress)
    {
        try {
            $isDefault = array_key_exists('is_default', $data);
            $data['is_default'] = $isDefault;
            $userAddress->update($data);

            if ($isDefault) {
                UserAddress::where('address_type', $data['address_type'])
                    ->where('id', '!=', $userAddress->id)
                    ->update(['is_default' => 0]);
            }

            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Address update failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while updating the address. Please try again.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        try {
            $userAddress->delete();

            return ['success' => true];
        } catch (\Exception $exception) {
            \Log::error('Address delete failed: ' . $exception->getMessage());

            return ['success' => false, 'message' => 'An error occurred while deleting the address. Please try again.'];
        }
    }
}
