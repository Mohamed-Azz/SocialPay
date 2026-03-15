<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>الاقتطاعات الشهرية</title>
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
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committeeDashboard/viewOperations">
                    <span class="material-symbols-outlined">history</span>
                    <span>سجل العمليات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structureDashboard/deductions">
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
                <h2 class="text-xl font-bold">اقتطاعات شهر: <?= $_GET['month'] ?? date('Y-m'); ?></h2>
                <div class="flex gap-2">
                    <form action="" method="GET" class="flex gap-2">
                        <input type="month" name="month" value="<?= $_GET['month'] ?? date('Y-m'); ?>" class="rounded-xl border-slate-200 text-sm focus:ring-primary py-2 px-4">
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-xl font-bold hover:bg-primary/90 text-sm">عرض</button>
                    </form>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 text-sm">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">الموظف</th>
                                    <th class="px-6 py-4 font-semibold">رقم الضمان</th>
                                    <th class="px-6 py-4 font-semibold">المبلغ (دج)</th>
                                    <th class="px-6 py-4 font-semibold">الحالة</th>
                                    <th class="px-6 py-4 font-semibold">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                <?php foreach($installments as $i): ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-sm"><?= $i['nom_ar']; ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500"><?= $i['ssn']; ?></td>
                                    <td class="px-6 py-4 font-bold text-sm"><?= number_format($i['amount'], 2); ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                            <?= $i['is_paid'] ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800'; ?>">
                                            <?= $i['is_paid'] ? 'تم الاقتطاع' : 'منتظر'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if(!$i['is_paid']): ?>
                                        <a href="<?= URLROOT; ?>/structureDashboard/confirmDeduction?id=<?= $i['id']; ?>" class="bg-primary/10 text-primary px-3 py-1 rounded-lg text-xs font-bold hover:bg-primary hover:text-white transition-colors">
                                            تأكيد الاسترجاع
                                        </a>
                                        <?php endif; ?>
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
