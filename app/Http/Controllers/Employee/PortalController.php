<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Grant;
use App\Models\Request as ServiceRequest;
use App\Models\Mandate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortalController extends Controller
{
    public function index()
    {
        $employeeId = Session::get('employee_id');
        if (!$employeeId) return redirect()->route('employee.login');

        $employee = Employee::find($employeeId);
        $mandate = Mandate::where('is_active', true)->first();

        // Latest request by employee
        $latestRequest = ServiceRequest::where('employee_id', $employeeId)
                                      ->with('grant')
                                      ->latest()
                                      ->first();

        // Get all grants
        $grants = Grant::with('bab')->get();

        return view('employee.portal.index', compact('employee', 'grants', 'latestRequest', 'mandate'));
    }

    public function storeRequest(Request $request)
    {
        $employeeId = Session::get('employee_id');
        $grant = Grant::findOrFail($request->grant_id);
        $mandate = Mandate::where('is_active', true)->first();

        if (!$mandate) {
            return redirect()->back()->withErrors(['error' => 'لا توجد عهدة نشطة حالياً']);
        }

        if ($mandate->budget < $grant->amount) {
            return redirect()->back()->withErrors(['error' => 'الميزانية غير كافية حالياً']);
        }

        // Logic for checking previous loans
        if ($grant->bab->type != 'grant') {
            // Check if there are ANY unpaid installments for THIS employee
            $unpaid = \App\Models\Installment::whereHas('payment', function($q) use ($employeeId) {
                $q->whereHas('request', function($qr) use ($employeeId) {
                    $qr->where('employee_id', $employeeId);
                });
            })->where('is_paid', false)->exists();

            if ($unpaid) {
                return redirect()->back()->withErrors(['error' => 'لا يمكنك تقديم طلب سلفة جديد حتى تسديد جميع أقساط السلفة السابقة']);
            }
        }

        $serviceRequest = new ServiceRequest();
        $serviceRequest->employee_id = $employeeId;
        $serviceRequest->grant_id = $grant->id;
        $serviceRequest->mandate_id = $mandate->id;
        $serviceRequest->status = 'pending';

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('requests', 'public');
            $serviceRequest->file_path = $path;
        }

        $serviceRequest->save();

        return redirect()->back()->with('success', 'تم تقديم طلبك بنجاح');
    }
}
