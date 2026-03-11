@extends('layouts.admin')

@section('title', 'سجل المدفوعات')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">العمليات التي تم دفعها</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>المرجع</th>
                    <th>المستفيد</th>
                    <th>المبلغ</th>
                    <th>التاريخ</th>
                    <th>الملفات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->reference_number }}</td>
                    <td>{{ $payment->request->employee->nom_ar }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        <a href="{{ route('structure.payments.txt', $payment->id) }}" class="btn btn-sm btn-outline-dark">TXT</a>
                        <a href="{{ route('structure.payments.pdf', $payment->id) }}" class="btn btn-sm btn-outline-danger" target="_blank">PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
