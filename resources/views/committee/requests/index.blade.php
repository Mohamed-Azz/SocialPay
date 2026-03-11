@extends('layouts.admin')

@section('title', 'دراسة الطلبات')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">الطلبات المقدمة للدراسة</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الموظف</th>
                        <th>المنحة</th>
                        <th>التاريخ</th>
                        <th>الملف</th>
                        <th>الحالة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->employee->nom_ar }} {{ $request->employee->prenom_ar }}</td>
                        <td>{{ $request->grant->name }}</td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($request->file_path)
                                <a href="{{ asset('storage/' . $request->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">عرض PDF</a>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending') <span class="badge bg-warning text-dark">قيد الدراسة</span>
                            @elseif($request->status == 'beneficiary') <span class="badge bg-success">مستفيد</span>
                            @else <span class="badge bg-danger">{{ $request->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending')
                                {{-- Placeholder for Auth check: if(Auth::user()->role == 'chairman') --}}
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#processModal{{ $request->id }}">دراسة</button>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="processModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('committee.requests.process', $request->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">دراسة ملف {{ $request->employee->nom_ar }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">القرار</label>
                                            <select name="action" class="form-select" required>
                                                <option value="accepted">قبول الطلب وتأكيد الاستفادة</option>
                                                <option value="rejected_temp">رفض مؤقت (نقص وثائق)</option>
                                                <option value="rejected_final">رفض نهائي (غير مؤهل)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ملاحظات (سبب الرفض إن وجد)</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-primary">حفظ القرار</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
