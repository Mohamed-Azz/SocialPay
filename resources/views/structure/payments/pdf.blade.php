<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مقرر دفع</title>
    <style>
        body { font-family: 'Arial', sans-serif; padding: 50px; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 30px; }
        .content { font-size: 18px; line-height: 1.6; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>مديرية الخدمات الجامعية</h2>
        <h3>لجنة الخدمات الاجتماعية</h3>
    </div>
    <div class="content">
        <h2 style="text-align: center;">مقرر دفع رقم: {{ $payment->reference_number }}</h2>
        <p>بناءً على مداولة لجنة الخدمات الاجتماعية، تقرر دفع مبلغ وقدره: <strong>{{ number_format($payment->amount, 2) }} دج</strong></p>
        <p>للمستفيد السيد(ة): <strong>{{ $payment->request->employee->nom_ar }} {{ $payment->request->employee->prenom_ar }}</strong></p>
        <p>نوع الاستفادة: {{ $payment->request->grant->name }}</p>
        <p>الحساب البنكي (RIB): {{ $payment->request->employee->num_compte }}</p>
        <p>تاريخ العملية: {{ $payment->payment_date }}</p>
    </div>
    <div class="footer">
        <div>توقيع محاسب اللجنة</div>
        <div>توقيع رئيس اللجنة</div>
    </div>
</body>
</html>
