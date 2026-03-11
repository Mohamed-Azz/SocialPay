<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('employee.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ssn' => 'required|digits:12',
            'dob' => 'required|date_format:dmY', // e.g. 10021999
        ]);

        $dob = \Carbon\Carbon::createFromFormat('dmY', $request->dob)->format('Y-m-d');

        $employee = Employee::where('ssn', $request->ssn)
                            ->where('date_naissance', $dob)
                            ->first();

        if ($employee) {
            Session::put('employee_id', $employee->id);
            return redirect()->route('employee.portal.index');
        }

        return redirect()->back()->withErrors(['error' => 'بيانات غير صحيحة']);
    }

    public function logout()
    {
        Session::forget('employee_id');
        return redirect()->route('employee.login');
    }
}
