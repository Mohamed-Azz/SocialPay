<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h3>نظرة عامة على الطلبات</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">جميع الطلبات (demandes)</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead><tr><th>الموظف</th><th>المنحة</th><th>الحالة</th></tr></thead>
                            <tbody>
                                <?php foreach($allRequests as $r): ?>
                                <tr><td><?= $r['nom_ar']; ?></td><td><?= $r['grant_name']; ?></td><td><?= $r['status']; ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">الطلبات المدروسة (traitement)</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead><tr><th>الموظف</th><th>المبلغ</th><th>التاريخ</th></tr></thead>
                            <tbody>
                                <?php foreach($studiedRequests as $p): ?>
                                <tr><td><?= $p['nom_ar']; ?></td><td><?= number_format($p['amount'], 2); ?></td><td><?= $p['payment_date']; ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
