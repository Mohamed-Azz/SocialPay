@extends('layouts.admin')

@section('title', 'تأكيد الدفع')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">الطلبات المقبولة لعملية الدفع</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الموظف</th>
                        <th>المنحة</th>
                        <th>المبلغ</th>
                        <th>الحساب البنكي</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvedRequests as $request)
                    <tr>
                        <td>{{ $request->employee->nom_ar }}</td>
                        <td>{{ $request->grant->name }}</td>
                        <td>{{ number_format($request->grant->amount, 2) }}</td>
                        <td>{{ $request->employee->num_compte }}</td>
                        <td>
                            @if(in_array(auth()->user()->role, ['accountant', 'manager']))
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#payModal{{ $request->id }}">تأكيد الدفع</button>
                            @else
                            <span class="text-muted">للعرض فقط</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="payModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('structure.payments.process', $request->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">تأكيد عملية دفع لـ {{ $request->employee->nom_ar }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">المبلغ</label>
                                            <input type="number" name="amount" class="form-control" value="{{ $request->grant->amount }}" step="0.01" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">مصاريف البنك</label>
                                            <input type="number" name="bank_fees" class="form-control" placeholder="0.00" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-primary">تأكيد وتوليد الملفات</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">لا توجد طلبات معلقة للدفع</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
