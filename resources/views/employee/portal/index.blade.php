<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>بوابة الموظف - {{ $employee->nom_ar ?: $employee->nom }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background: #f8f9fa; }
        .grant-card { border: 1px solid #ddd; border-radius: 10px; padding: 20px; background: #fff; margin-bottom: 20px; transition: 0.3s; }
        .grant-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .header-bg { background: #3498db; color: #fff; padding: 30px 0; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header-bg">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>مرحباً، {{ $employee->nom_ar ?: $employee->nom }} {{ $employee->prenom_ar ?: $employee->prenom }}</h2>
                    <p class="mb-0">رقم الضمان: {{ $employee->ssn }}</p>
                </div>
                <form action="{{ route('employee.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">تسجيل الخروج</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        @if($latestRequest)
        <div class="card border-primary mb-4">
            <div class="card-header bg-primary text-white">حالة الطلب الأخير</div>
            <div class="card-body">
                <p>نوع المنحة: <strong>{{ $latestRequest->grant->name }}</strong></p>
                <p>تاريخ الطلب: <strong>{{ $latestRequest->created_at->format('Y-m-d') }}</strong></p>
                <p>الحالة:
                    @if($latestRequest->status == 'pending') <span class="badge bg-warning text-dark">قيد الدراسة</span>
                    @elseif($latestRequest->status == 'beneficiary') <span class="badge bg-success">مستفيد</span>
                    @elseif($latestRequest->status == 'rejected_temp') <span class="badge bg-danger">مرفوض مؤقتاً</span>
                    @else <span class="badge bg-dark">مرفوض نهائياً</span>
                    @endif
                </p>
            </div>
        </div>
        @endif

        <h3 class="mb-4">المنح والهبات المتوفرة</h3>
        <div class="row">
            @foreach($grants as $grant)
            <div class="col-md-4">
                <div class="grant-card">
                    <h5>{{ $grant->name }}</h5>
                    <p class="text-muted small">نوع الباب: {{ $grant->bab->name }}</p>
                    <p class="mb-1 text-primary">المبلغ: <strong>{{ number_format($grant->amount, 2) }} دج</strong></p>
                    <button class="btn btn-sm btn-outline-info w-100 mt-2" data-bs-toggle="modal" data-bs-target="#modal{{ $grant->id }}">تفاصيل وتقديم</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal{{ $grant->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('employee.request.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="grant_id" value="{{ $grant->id }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">تفاصيل منحة {{ $grant->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <h6>شروط الاستفادة:</h6>
                                    <p>{{ $grant->conditions ?: 'لا توجد شروط خاصة' }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6>الوثائق المطلوبة:</h6>
                                    <p>{{ $grant->required_documents ?: 'يرجى تحميل ملف متكامل' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">تحميل ملف PDF متكامل للملف</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-success">تأكيد الطلب</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
