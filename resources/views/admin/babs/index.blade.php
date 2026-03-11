@extends('layouts.admin')

@section('title', 'إدارة الأبواب')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">إضافة باب جديد</div>
            <div class="card-body">
                <form action="{{ route('admin.babs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">اسم الباب</label>
                        <input type="text" name="name" class="form-control" placeholder="مثال: هبات" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">النوع</label>
                        <select name="type" class="form-select" required>
                            <option value="grant">هبة لا ترد</option>
                            <option value="loan_full">سلفة ترد كاملة</option>
                            <option value="loan_partial">سلفة ترد جزئياً</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">حفظ</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">قائمة الأبواب</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>النوع</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($babs as $bab)
                        <tr>
                            <td>{{ $bab->name }}</td>
                            <td>{{ $bab->type }}</td>
                            <td>
                                <form action="{{ route('admin.babs.destroy', $bab->id) }}" method="POST">
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
