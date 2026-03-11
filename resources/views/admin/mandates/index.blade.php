@extends('layouts.admin')

@section('title', 'إدارة العهدات')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">إنشاء عهدة جديدة</div>
            <div class="card-body">
                <form action="{{ route('admin.mandates.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">اسم العهدة</label>
                        <input type="text" name="name" class="form-control" placeholder="مثال: عهدة 2024/2027" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تاريخ البدء</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تاريخ الانتهاء</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الميزانية السنوية (دج)</label>
                        <input type="number" name="budget" class="form-control" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">حفظ العهدة</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">قائمة العهدات</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>العهد</th>
                            <th>الميزانية المتبقية</th>
                            <th>الحالة</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mandates as $mandate)
                        <tr>
                            <td>{{ $mandate->name }}</td>
                            <td>{{ number_format($mandate->budget, 2) }} دج</td>
                            <td>
                                @if($mandate->is_active)
                                    <span class="badge bg-success">نشطة</span>
                                @else
                                    <span class="badge bg-secondary">غير نشطة</span>
                                @endif
                            </td>
                            <td>
                                @if(!$mandate->is_active)
                                <form action="{{ route('admin.mandates.activate', $mandate->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">تفعيل</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
