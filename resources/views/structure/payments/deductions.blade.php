@extends('layouts.admin')

@section('title', 'متابعة الاقتطاعات')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h5 class="mb-0">قائمة الاقتطاعات لشهر: {{ $month }}</h5>
        <form action="{{ route('structure.payments.deductions') }}" method="GET" class="d-flex">
            <input type="month" name="month" class="form-control form-control-sm me-2" value="{{ $month }}">
            <button type="submit" class="btn btn-light btn-sm">عرض</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>الموظف</th>
                    <th>المبلغ للمقتطع</th>
                    <th>تاريخ الاستحقاق</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installments as $inst)
                <tr>
                    <td>{{ $inst->payment->request->employee->nom_ar }}</td>
                    <td>{{ number_format($inst->amount, 2) }} دج</td>
                    <td>{{ $inst->due_date }}</td>
                    <td>
                        @if($inst->is_paid) <span class="badge bg-success">تم التحصيل</span>
                        @else <span class="badge bg-warning text-dark">منتظر</span>
                        @endif
                    </td>
                    <td>
                        @if(!$inst->is_paid)
                            @if(in_array(auth()->user()->role, ['accountant', 'manager']))
                            <form action="{{ route('structure.payments.mark_paid', $inst->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">تأكيد الاستلام</button>
                            </form>
                            @else
                            <span class="text-muted">للعرض فقط</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
