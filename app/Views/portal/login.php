<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الموظف</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card p-4 shadow" style="width: 400px;">
        <h3 class="text-center mb-4">بوابة الموظف</h3>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <form action="/portal/auth" method="POST">
            <div class="mb-3">
                <label class="form-label">رقم الضمان الاجتماعي (12 رقم)</label>
                <input type="text" name="ssn" class="form-control" maxlength="12" required>
            </div>
            <div class="mb-3">
                <label class="form-label">تاريخ الميلاد (مثال: 10021999)</label>
                <input type="text" name="dob" class="form-control" maxlength="8" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">دخول</button>
        </form>
    </div>
</body>
</html>
