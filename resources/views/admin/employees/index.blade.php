@extends('layouts.admin')

@section('title', 'إدارة العمال')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">قائمة العمال والموظفين</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">استيراد من Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>الهيكل</th>
                        <th>رقم الضمان</th>
                        <th>الاسم</th>
                        <th>اللقب</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->structure }}</td>
                        <td>{{ $employee->ssn }}</td>
                        <td>{{ $employee->nom_ar ?: $employee->nom }}</td>
                        <td>{{ $employee->prenom_ar ?: $employee->prenom }}</td>
                        <td><span class="badge bg-success">{{ $employee->position }}</span></td>
                        <td>
                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">لا يوجد عمال مسجلون</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.employees.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">استيراد بيانات من Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">اختر الملف (.xlsx, .xls)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-modal="dismiss">إلغاء</button>
                    <button type="submit" class="btn btn-primary">رفع ومعالجة</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
