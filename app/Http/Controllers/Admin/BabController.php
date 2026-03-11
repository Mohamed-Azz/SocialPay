<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bab;
use Illuminate\Http\Request;

class BabController extends Controller
{
    public function index()
    {
        $babs = Bab::all();
        return view('admin.babs.index', compact('babs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:grant,loan_full,loan_partial'
        ]);

        Bab::create($request->all());
        return redirect()->back()->with('success', 'تم إضافة الباب بنجاح');
    }

    public function destroy(Bab $bab)
    {
        $bab->delete();
        return redirect()->back()->with('success', 'تم حذف الباب بنجاح');
    }
}
