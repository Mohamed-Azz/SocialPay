<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مقرر دفع</title>
    <style>body { font-family: sans-serif; padding: 40px; } .header { border-bottom: 2px solid #000; text-align: center; }</style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>مقرر صرف منحة/سلفة</h2>
    </div>
    <div class="content mt-4">
        <p>المرجع: <?= $payment['reference_number']; ?></p>
        <p>بناءً على الملف المقدم، يستفيد السيد(ة): <strong><?= $payment['nom_ar']; ?></strong></p>
        <p>من منحة: <?= $payment['grant_name']; ?></p>
        <p>المبلغ: <strong><?= number_format($payment['amount'], 2); ?> دج</strong></p>
        <p>الحساب البنكي: <?= $payment['num_compte']; ?></p>
        <p>تاريخ الصرف: <?= $payment['payment_date']; ?></p>
    </div>
</body>
</html>
