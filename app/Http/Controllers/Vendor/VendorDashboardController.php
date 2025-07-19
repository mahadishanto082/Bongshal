<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorDashboardController extends Controller
{
    //
    public function index()
    {
        return view('website.vendor.dashboard'); // Ensure this view exists
    }
    public function createProduct()
    
    {
        return view('website.vendor.products.create'); // Ensure this view exists
    }
}
