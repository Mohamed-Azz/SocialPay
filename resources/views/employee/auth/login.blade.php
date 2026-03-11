<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الموظف</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background: #f0f2f5; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 400px; padding: 30px; border-radius: 15px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="text-center mb-4">بوابة الموظف</h3>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('employee.login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">رقم الضمان الاجتماعي (12 رقم)</label>
                <input type="text" name="ssn" class="form-control" maxlength="12" placeholder="مثال: 990992009999" required>
            </div>
            <div class="mb-3">
                <label class="form-label">تاريخ الميلاد (دون / أو -)</label>
                <input type="text" name="dob" class="form-control" maxlength="8" placeholder="مثال: 10021999" required>
                <small class="text-muted">يوم-شهر-سنة (مثلاً 10 فبراير 1999 تكتب 10021999)</small>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">دخول</button>
        </form>
    </div>
</body>
</html>
