<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>دراسة الطلبات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h3>طلبات بانتظار الدراسة</h3>
        <table class="table card shadow-sm mt-3">
            <thead>
                <tr>
                    <th>الموظف</th>
                    <th>المنحة</th>
                    <th>الملف</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($requests as $r): ?>
                <tr>
                    <td><?= $r['nom_ar']; ?></td>
                    <td><?= $r['grant_name']; ?></td>
                    <td><a href="/<?= $r['file_path']; ?>" class="btn btn-sm btn-info" target="_blank">فتح PDF</a></td>
                    <td>
                        <?php if($_SESSION['role'] == 'chairman' && $r['status'] == 'pending'): ?>
                        <form action="/committee/process" method="POST" class="d-inline">
                            <input type="hidden" name="request_id" value="<?= $r['id']; ?>">
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto">
                                <option value="beneficiary">موافقة</option>
                                <option value="rejected_temp">رفض مؤقت</option>
                                <option value="rejected_final">رفض نهائي</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">حفظ</button>
                        </form>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= $r['status']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
