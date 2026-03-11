<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true])) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role == 'admin') return redirect()->route('admin.dashboard');
            if (in_array($user->role, ['chairman', 'member'])) return redirect()->route('committee.requests.index');
            if (in_array($user->role, ['accountant', 'manager'])) return redirect()->route('structure.payments.index');

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'البيانات المدخلة غير صحيحة أو الحساب معطل.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
