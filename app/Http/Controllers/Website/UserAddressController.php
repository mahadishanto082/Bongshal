<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserAddressRequest;
use App\Models\UserAddress;
use App\Services\UserAddressService;

class UserAddressController extends Controller
{
    /**
     * The UserAddressService instance.
     *
     * @var UserAddressService $addressService
     */
    private UserAddressService $addressService;

    /**
     * Create a new controller instance.
     *
     * @param void
     * @return void
     */
    public function __construct(UserAddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->addressService->index();

        if ($result['success']) {
            return view('website.user.address.index', ['data' => $result['data']]);
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddressRequest $request)
    {
        $result = $this->addressService->store($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Address created successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        return view('website.user.address.edit', ['userAddress' => $userAddress]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAddressRequest $request, UserAddress $userAddress)
    {
        $result = $this->addressService->update($request->validated(), $userAddress);

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Address updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        $result = $this->addressService->destroy($userAddress);

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Address deleted successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }
}
