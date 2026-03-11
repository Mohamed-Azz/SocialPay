@extends('layouts.admin')

@section('title', 'إدارة المنح')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">إضافة منحة جديدة</div>
            <div class="card-body">
                <form action="{{ route('admin.grants.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">الباب</label>
                        <select name="bab_id" class="form-select" required>
                            @foreach($babs as $bab)
                            <option value="{{ $bab->id }}">{{ $bab->name }} ({{ $bab->type }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">اسم المنحة</label>
                        <input type="text" name="name" class="form-control" placeholder="مثال: منحة زواج" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">المبلغ (دج)</label>
                        <input type="number" name="amount" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نسبة الاسترداد (%)</label>
                        <input type="number" name="repayment_percentage" class="form-control" value="0" step="0.01" required>
                        <small class="text-muted">0 للهبات، 100 للسلف الكاملة</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">عدد أشهر الاقتطاع</label>
                        <input type="number" name="installments_count" class="form-control" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الشروط</label>
                        <textarea name="conditions" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الوثائق المطلوبة</label>
                        <textarea name="required_documents" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">حفظ</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">قائمة المنح</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الباب</th>
                            <th>المبلغ</th>
                            <th>أشهر الاقتطاع</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grants as $grant)
                        <tr>
                            <td>{{ $grant->name }}</td>
                            <td>{{ $grant->bab->name }}</td>
                            <td>{{ number_format($grant->amount, 2) }}</td>
                            <td>{{ $grant->installments_count }}</td>
                            <td>
                                <form action="{{ route('admin.grants.destroy', $grant->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
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
