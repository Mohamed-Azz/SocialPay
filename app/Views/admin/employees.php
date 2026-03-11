<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة العمال</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">لوحة تحكم Admin</a>
            <div class="navbar-nav">
                <a class="nav-link active" href="/admin/employees">العمال</a>
                <a class="nav-link" href="/admin/users">المستخدمين</a>
                <a class="nav-link" href="/auth/logout">خروج</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>قائمة العمال</h3>
            <form action="/admin/import" method="POST" enctype="multipart/form-data" class="d-flex">
                <input type="file" name="file" class="form-control me-2" required>
                <button type="submit" class="btn btn-success">استيراد CSV</button>
            </form>
        </div>

        <div class="card p-3 shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>الماتريكول</th>
                        <th>الاسم</th>
                        <th>اللقب</th>
                        <th>رقم الضمان</th>
                        <th>الهيكل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $emp): ?>
                    <tr>
                        <td><?= $emp['matricule']; ?></td>
                        <td><?= $emp['nom_ar']; ?></td>
                        <td><?= $emp['prenom_ar']; ?></td>
                        <td><?= $emp['ssn']; ?></td>
                        <td><?= $emp['structure']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
