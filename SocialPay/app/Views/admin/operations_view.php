<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عرض العمليات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h3>سجل عمليات هيكل التسيير</h3>
        <table class="table card shadow-sm p-3">
            <thead>
                <tr><th>الموظف</th><th>المبلغ</th><th>الرسوم</th><th>التاريخ</th><th>المرجع</th></tr>
            </thead>
            <tbody>
                <?php foreach($payments as $p): ?>
                <tr>
                    <td><?= $p['nom_ar']; ?></td>
                    <td><?= number_format($p['amount'], 2); ?></td>
                    <td><?= number_format($p['bank_fees'], 2); ?></td>
                    <td><?= $p['payment_date']; ?></td>
                    <td><?= $p['reference_number']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
