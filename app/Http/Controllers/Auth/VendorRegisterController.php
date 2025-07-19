<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class VendorRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/vendor/dashboard';

    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function showRegistrationForm()
    {
        return view('website.vendor.auth.register'); // create this view
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'string', 'max:15', 'unique:vendors'],
            'address' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'max:2048'], // optional logo upload
            
        ]);
    }

    protected function create(array $data)
    {
        return Vendor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard()
    {
        return auth()->guard('vendor');
    }
}
