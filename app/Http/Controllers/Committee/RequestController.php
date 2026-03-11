<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Models\Request as ServiceRequest;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('employee', 'grant')->get();
        return view('committee.requests.index', compact('requests'));
    }

    public function process(Request $request, ServiceRequest $serviceRequest)
    {
        if (Auth::user()->role != 'chairman') {
            return abort(403, 'رئيس اللجنة فقط يمكنه تأكيد المنحة');
        }

        $request->validate([
            'action' => 'required|in:accepted,rejected_temp,rejected_final',
        ]);

        $serviceRequest->status = $this->getStatusFromAction($request->action);
        $serviceRequest->rejection_reason = $request->comment;
        $serviceRequest->save();

        Treatment::create([
            'request_id' => $serviceRequest->id,
            'user_id' => Auth::id(),
            'action' => $request->action,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'تمت معالجة الطلب بنجاح');
    }

    private function getStatusFromAction($action)
    {
        switch ($action) {
            case 'accepted': return 'beneficiary';
            case 'rejected_temp': return 'rejected_temp';
            case 'rejected_final': return 'rejected_final';
            default: return 'pending';
        }
    }
}
