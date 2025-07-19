<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly ReportService $reportService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function orders(Request $request)
    {
        $result = $this->reportService->orders($request);

        if ($result['success']) {
            return view('admin.reports.orders', $result['data']);
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function ledger(Request $request)
    {
        $result = $this->reportService->ledger($request);

        if ($result['success']) {
            return view('admin.reports.ledger', $result['data']);
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }
}
