<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>مقرر دفع</title>
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
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-10 font-display" onload="window.print()">
    <div class="max-w-3xl mx-auto bg-white p-12 border shadow-lg rounded-xl relative overflow-hidden">
        <!-- Header -->
        <div class="flex justify-between items-start border-b-2 border-primary pb-8 mb-8">
            <div>
                <h1 class="text-2xl font-black text-slate-900 mb-2">لجنة الخدمات الاجتماعية</h1>
                <p class="text-slate-500 font-bold">هيكل التسيير</p>
            </div>
            <div class="text-left">
                <p class="text-slate-400 text-xs mb-1">المرجع</p>
                <p class="font-mono font-bold text-slate-900"><?= $payment['reference_number']; ?></p>
            </div>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-slate-900 underline decoration-primary decoration-4 underline-offset-8">مقرر صرف منحة / سلفة</h2>
        </div>

        <div class="space-y-8 text-lg leading-loose text-slate-800">
            <p>بناءً على الملف المقدم والمقبول من طرف لجنة الخدمات الاجتماعية، يستفيد السيد(ة):</p>

            <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-slate-400 mb-1">الاسم واللقب</p>
                        <p class="font-black text-xl text-slate-900"><?= $payment['nom_ar']; ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 mb-1">نوع الاستفادة</p>
                        <p class="font-bold text-slate-900"><?= $payment['grant_name']; ?></p>
                    </div>
                </div>
            </div>

            <p>بمبلغ إجمالي قدره: <span class="text-2xl font-black text-primary mx-2"><?= number_format($payment['amount'], 2); ?> دج</span></p>

            <div class="grid grid-cols-2 gap-12 mt-12">
                <div>
                    <p class="text-sm font-bold text-slate-400 mb-2">رقم الحساب البنكي (CCP/Bank)</p>
                    <p class="font-mono font-bold text-slate-900 bg-slate-50 p-3 rounded-lg border"><?= $payment['num_compte']; ?></p>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 mb-2">تاريخ الصرف</p>
                    <p class="font-bold text-slate-900 bg-slate-50 p-3 rounded-lg border text-center"><?= $payment['payment_date']; ?></p>
                </div>
            </div>
        </div>

        <!-- Footer / Signatures -->
        <div class="mt-24 grid grid-cols-2 gap-24 text-center">
            <div>
                <p class="font-bold mb-12">رئيس لجنة الخدمات</p>
                <div class="w-40 h-20 border-2 border-dashed border-slate-200 mx-auto rounded-xl"></div>
            </div>
            <div>
                <p class="font-bold mb-12">المسؤول المالي</p>
                <div class="w-40 h-20 border-2 border-dashed border-slate-200 mx-auto rounded-xl"></div>
            </div>
        </div>

        <div class="mt-20 pt-8 border-t text-center no-print">
            <button onclick="window.print()" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-primary/30 hover:scale-105 transition-all">طباعة المقرر</button>
        </div>

        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>
    </div>
</body>
</html>
