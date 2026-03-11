<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة الاقتطاعات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h3>اقتطاعات شهر: <?= $_GET['month'] ?? date('Y-m'); ?></h3>
        <table class="table card shadow-sm p-3">
            <thead>
                <tr><th>الموظف</th><th>رقم الضمان</th><th>المبلغ</th><th>الحالة</th><th>الإجراء</th></tr>
            </thead>
            <tbody>
                <?php foreach($installments as $i): ?>
                <tr>
                    <td><?= $i['nom_ar']; ?></td>
                    <td><?= $i['ssn']; ?></td>
                    <td><?= number_format($i['amount'], 2); ?></td>
                    <td><?= $i['is_paid'] ? 'تم الاقتطاع' : 'منتظر'; ?></td>
                    <td>
                        <?php if(!$i['is_paid']): ?>
                        <a href="/structureDashboard/confirmDeduction?id=<?= $i['id']; ?>" class="btn btn-sm btn-success">تأكيد الاسترجاع</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
