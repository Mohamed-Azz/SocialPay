<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>سجل العمليات</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&amp;family=Noto+Sans+Arabic:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec5b13",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221610",
                    },
                    fontFamily: {
                        "display": ["Noto Sans Arabic", "Public Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Noto Sans Arabic', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->



        <aside class="w-72 bg-white dark:bg-stone-900 border-l border-slate-200 dark:border-stone-800 flex flex-col h-full shadow-sm">
            <div class="p-6 border-b border-slate-200 dark:border-stone-800 flex items-center gap-3">
                <div class="bg-primary p-2 rounded-lg text-white">
                    <span class="material-symbols-outlined block">admin_panel_settings</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight">نظام الإدارة</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">لوحة تحكم المسير</p>
                </div>
            </div>
            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/dashboard">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>لوحة التحكم الرئيسية</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/employees">
                    <span class="material-symbols-outlined">group</span>
                    <span>إدارة الموظفين</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/mandates">
                    <span class="material-symbols-outlined">event_note</span>
                    <span>إدارة العهد</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/grants">
                    <span class="material-symbols-outlined">account_balance</span>
                    <span>إدارة المنح</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/users">
                    <span class="material-symbols-outlined">manage_accounts</span>
                    <span>إدارة المستخدمين</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committee/requests">
                    <span class="material-symbols-outlined">assignment</span>
                    <span>دراسة الطلبات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structure/payments">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                    <span>المدفوعات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committeeDashboard/viewOperations">
                    <span class="material-symbols-outlined">history</span>
                    <span>سجل العمليات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structureDashboard/deductions">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span>الاقتطاعات الشهرية</span>
                </a>
                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-stone-800">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/auth/logout">
                        <span class="material-symbols-outlined text-red-500">logout</span>
                        <span>تسجيل الخروج</span>
                    </a>
                </div>
            </nav>
        </aside>




        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-20 bg-white dark:bg-stone-900 border-b border-slate-200 dark:border-stone-800 px-8 flex items-center justify-between">
                <h2 class="text-xl font-bold">سجل العمليات المالية</h2>
                <div class="flex gap-2">
                    <button class="bg-white border rounded-xl px-4 py-2 text-sm font-bold flex items-center gap-2 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-sm">print</span>
                        <span>طباعة السجل</span>
                    </button>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <!-- Advanced Search Section -->
                <div class="bg-white dark:bg-stone-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 space-y-4">
                    <div class="flex items-center gap-2 mb-2 text-slate-700 dark:text-slate-200 font-bold">
                        <span class="material-symbols-outlined text-primary">filter_alt</span>
                        <span>بحث متقدم</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="space-y-1">
                            <label class="text-xs text-slate-500 font-medium px-1">بحث نصي</label>
                            <input type="text" placeholder="اسم الموظف أو المرجع..." class="w-full px-4 py-2 rounded-xl border-slate-200 focus:ring-primary focus:border-primary text-sm">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs text-slate-500 font-medium px-1">من تاريخ</label>
                            <input type="date" class="w-full px-4 py-2 rounded-xl border-slate-200 text-sm">
                        </div>
                        <button class="bg-primary text-white py-2 rounded-xl font-bold text-sm hover:bg-primary/90 transition-all">تطبيق الفلتر</button>
                    </div>
                </div>

                <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 text-sm">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">الموظف</th>
                                    <th class="px-6 py-4 font-semibold">المبلغ (دج)</th>
                                    <th class="px-6 py-4 font-semibold">الرسوم البنكية</th>
                                    <th class="px-6 py-4 font-semibold">التاريخ</th>
                                    <th class="px-6 py-4 font-semibold">المرجع</th>
                                    <th class="px-6 py-4 font-semibold">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                <?php foreach($payments as $p): ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30">
                                    <td class="px-6 py-4 font-bold text-sm"><?= $p['nom_ar']; ?></td>
                                    <td class="px-6 py-4 text-sm"><?= number_format($p['amount'], 2); ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-500"><?= number_format($p['bank_fees'], 2); ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-400"><?= $p['payment_date']; ?></td>
                                    <td class="px-6 py-4 text-sm font-mono"><?= $p['reference_number']; ?></td>
                                    <td class="px-6 py-4">
                                        <a href="<?= URLROOT; ?>/structureDashboard/printOrder?id=<?= $p['id']; ?>" target="_blank" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined">print</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
