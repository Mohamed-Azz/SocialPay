<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>طباعة القائمة الاسمية</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&amp;family=Noto+Sans+Arabic:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: { "primary": "#ec5b13" },
                    fontFamily: { "display": ["Noto Sans Arabic", "Public Sans", "sans-serif"] },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Noto Sans Arabic', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .print-border { border: 1px solid #e2e8f0 !important; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-10 font-display" onload="window.print()">
    <div class="max-w-4xl mx-auto bg-white p-10 border shadow-lg rounded-xl">
        <div class="flex justify-between items-start border-b-2 border-primary pb-6 mb-8">
            <div>
                <h1 class="text-xl font-black text-slate-900 mb-1">لجنة الخدمات الاجتماعية</h1>
                <p class="text-slate-500 font-bold text-sm">القائمة الاسمية للتحويل البنكي</p>
            </div>
            <div class="text-left text-sm">
                <p class="font-bold text-slate-900">الرقم: VIR-<?= $virement['id']; ?></p>
                <p class="text-slate-500">التاريخ: <?= $virement['transfer_date']; ?></p>
            </div>
        </div>

        <div class="mb-8">
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-slate-50 p-4 rounded-xl border">
                    <p class="text-xs text-slate-400 mb-1">عدد المستفيدين</p>
                    <p class="font-black text-lg text-slate-900"><?= $virement['beneficiary_count']; ?></p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border">
                    <p class="text-xs text-slate-400 mb-1">المبلغ الإجمالي</p>
                    <p class="font-black text-lg text-primary"><?= number_format($virement['total_amount'], 2); ?> دج</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border">
                    <p class="text-xs text-slate-400 mb-1">الرسوم البنكية</p>
                    <p class="font-black text-lg text-slate-900"><?= number_format($virement['bank_fees'], 2); ?> دج</p>
                </div>
            </div>
        </div>

        <div class="overflow-hidden border rounded-xl print-border">
            <table class="w-full text-right text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 font-bold border-b">المستفيد</th>
                        <th class="px-4 py-3 font-bold border-b">رقم الحساب البنكي</th>
                        <th class="px-4 py-3 font-bold border-b">نوع الاستفادة</th>
                        <th class="px-4 py-3 font-bold border-b text-left">المبلغ</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php foreach($details as $d): ?>
                    <tr>
                        <td class="px-4 py-3 font-medium"><?= $d['nom_ar'] . ' ' . $d['prenom_ar']; ?></td>
                        <td class="px-4 py-3 font-mono"><?= $d['num_compte']; ?></td>
                        <td class="px-4 py-3 text-slate-500"><?= $d['grant_name']; ?></td>
                        <td class="px-4 py-3 font-bold text-left"><?= number_format($d['amount'], 2); ?> دج</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="bg-slate-50 font-black">
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-left">المجموع الكلي:</td>
                        <td class="px-4 py-4 text-left text-primary text-lg"><?= number_format($virement['total_amount'], 2); ?> دج</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-16 grid grid-cols-2 gap-20 text-center">
            <div>
                <p class="font-bold mb-12">المسؤول المالي</p>
                <div class="w-40 h-20 border-2 border-dashed border-slate-200 mx-auto rounded-xl"></div>
            </div>
            <div>
                <p class="font-bold mb-12">رئيس لجنة الخدمات</p>
                <div class="w-40 h-20 border-2 border-dashed border-slate-200 mx-auto rounded-xl"></div>
            </div>
        </div>

        <div class="mt-12 text-center no-print">
            <button onclick="window.print()" class="bg-primary text-white px-10 py-3 rounded-xl font-bold shadow-lg shadow-primary/30">طباعة الآن</button>
        </div>
    </div>
</body>
</html>
