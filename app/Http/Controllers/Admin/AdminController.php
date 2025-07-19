<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailUpdateRequest;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Services\Admin\AdminService;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected AdminService $adminService
    ){}

    /**
     * Show the form for admins profile update.
     */
    public function showProfileUpdateForm()
    {
        return view('admin.update-profile');
    }

    /**
     * Update admins profile.
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $result = $this->adminService->profileUpdate($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Profile updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Show the form for admins settings.
     */
    public function settings()
    {
        return view('admin.profile-settings');
    }

    /**
     * Update admins password.
     */
    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $result = $this->adminService->passwordUpdate($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Password updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withErrors(['password' => $result['message']]);
        }
    }

    /**
     * Update admins email.
     */
    public function emailUpdate(EmailUpdateRequest $request)
    {
        $result = $this->adminService->emailUpdate($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Email updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withErrors(['email' => $result['message']]);
        }
    }
}
