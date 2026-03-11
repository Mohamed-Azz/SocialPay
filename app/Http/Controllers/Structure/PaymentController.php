<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Request as ServiceRequest;
use App\Models\Payment;
use App\Models\Installment;
use App\Models\Mandate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $approvedRequests = ServiceRequest::where('status', 'beneficiary')
                                         ->whereDoesntHave('payment')
                                         ->with('employee', 'grant')
                                         ->get();
        return view('structure.payments.index', compact('approvedRequests'));
    }

    public function history()
    {
        $payments = Payment::with('request.employee', 'request.grant')->latest()->get();
        return view('structure.payments.history', compact('payments'));
    }

    public function processPayment(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'bank_fees' => 'required|numeric',
        ]);

        $mandate = Mandate::where('is_active', true)->first();
        if ($mandate->budget < ($request->amount + $request->bank_fees)) {
            return redirect()->back()->withErrors(['error' => 'الميزانية غير كافية لإتمام عملية الدفع']);
        }

        $payment = Payment::create([
            'request_id' => $serviceRequest->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'amount' => $request->amount,
            'bank_fees' => $request->bank_fees,
            'payment_date' => now(),
            'reference_number' => 'PAY-' . time(),
        ]);

        // Update Budget
        $mandate->budget -= ($request->amount + $request->bank_fees);
        $mandate->save();

        // Generate Installments if it's a loan
        $grant = $serviceRequest->grant;
        if ($grant->bab->type != 'grant') {
            $totalToRepay = $request->amount * ($grant->repayment_percentage / 100);
            $installmentAmount = $totalToRepay / $grant->installments_count;

            for ($i = 1; $i <= $grant->installments_count; $i++) {
                Installment::create([
                    'payment_id' => $payment->id,
                    'amount' => $installmentAmount,
                    'due_date' => Carbon::now()->addMonths($i)->startOfMonth(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'تم تأكيد الدفع وجدولة الأقساط');
    }

    public function monthlyDeductions(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $installments = Installment::where('due_date', 'like', "$month%")
                                    ->with('payment.request.employee')
                                    ->get();

        return view('structure.payments.deductions', compact('installments', 'month'));
    }

    public function markPaid(Installment $installment)
    {
        $installment->is_paid = true;
        $installment->paid_at = now();
        $installment->save();

        // Add back to budget
        $mandate = Mandate::where('is_active', true)->first();
        if ($mandate) {
            $mandate->budget += $installment->amount;
            $mandate->save();
        }

        return redirect()->back()->with('success', 'تم تسجيل التحصيل وتحديث الميزانية');
    }

    public function downloadTxt(Payment $payment)
    {
        $employee = $payment->request->employee;
        $content = "MATRICULE: " . $employee->matricule . "\r\n";
        $content .= "RIB: " . $employee->num_compte . "\r\n";
        $content .= "AMOUNT: " . $payment->amount . "\r\n";

        return response($content)
                ->header('Content-Type', 'text/plain')
                ->header('Content-Disposition', 'attachment; filename="payment_' . $payment->id . '.txt"');
    }

    public function downloadPdf(Payment $payment)
    {
        // For simplicity in this environment, we return a simple HTML view that can be printed as PDF
        return view('structure.payments.pdf', compact('payment'));
    }
}
