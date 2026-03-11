<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grant;
use App\Models\Bab;
use Illuminate\Http\Request;

class GrantController extends Controller
{
    public function index()
    {
        $grants = Grant::with('bab')->get();
        $babs = Bab::all();
        return view('admin.grants.index', compact('grants', 'babs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bab_id' => 'required|exists:babs,id',
            'name' => 'required',
            'amount' => 'required|numeric',
            'repayment_percentage' => 'required|numeric|min:0|max:100',
            'installments_count' => 'required|integer|min:0'
        ]);

        Grant::create($request->all());
        return redirect()->back()->with('success', 'تم إضافة المنحة بنجاح');
    }

    public function destroy(Grant $grant)
    {
        $grant->delete();
        return redirect()->back()->with('success', 'تم حذف المنحة بنجاح');
    }
}
