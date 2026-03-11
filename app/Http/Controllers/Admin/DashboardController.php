<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as ServiceRequest;
use App\Models\Treatment;

class DashboardController extends Controller
{
    public function index()
    {
        $allRequests = ServiceRequest::with('employee', 'grant')->latest()->get();
        $allTreatments = Treatment::with('request.employee')->latest()->get();

        return view('admin.dashboard.index', compact('allRequests', 'allTreatments'));
    }
}
