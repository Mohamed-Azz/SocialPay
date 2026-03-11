<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; }
        .sidebar { height: 100vh; background: #2c3e50; color: #fff; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #34495e; color: #fff; }
        .main-content { padding: 20px; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h4 class="text-center mb-4">الخدمات الاجتماعية</h4>
                <a href="{{ route('admin.employees.index') }}">إدارة العمال</a>
                <a href="{{ route('admin.users.index') }}">إدارة المستخدمين</a>
                <a href="{{ route('admin.mandates.index') }}">إدارة العهدات</a>
                <a href="{{ route('admin.babs.index') }}">إدارة الأبواب</a>
                <a href="{{ route('admin.grants.index') }}">إدارة المنح</a>
                <hr>
                <h6>هيكل التسيير</h6>
                <a href="{{ route('structure.payments.index') }}">تأكيد الدفع</a>
                <a href="{{ route('structure.payments.history') }}">سجل المدفوعات</a>
                <a href="{{ route('structure.payments.deductions') }}">الاقتطاعات</a>
                <hr>
                <h6>اللجنة</h6>
                <a href="{{ route('committee.requests.index') }}">دراسة الطلبات</a>
                <hr>
                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">تسجيل الخروج</button>
                </form>
            </div>
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
