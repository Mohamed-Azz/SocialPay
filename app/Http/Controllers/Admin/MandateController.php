<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mandate;
use Illuminate\Http\Request;

class MandateController extends Controller
{
    public function index()
    {
        $mandates = Mandate::all();
        return view('admin.mandates.index', compact('mandates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'budget' => 'required|numeric'
        ]);

        Mandate::create($request->all());

        return redirect()->back()->with('success', 'تم إنشاء العهدة بنجاح');
    }

    public function activate(Mandate $mandate)
    {
        Mandate::where('is_active', true)->update(['is_active' => false]);
        $mandate->is_active = true;
        $mandate->save();

        return redirect()->back()->with('success', 'تم تفعيل العهدة');
    }
}
