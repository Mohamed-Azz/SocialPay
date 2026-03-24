<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>تكوين القائمة الاسمية</title>
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
                    <span class="material-symbols-outlined block">account_balance</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight">لجنة الخدمات</h1>
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
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structure/payments">
                    <span class="material-symbols-outlined">payments</span>
                    <span>إدارة عمليات الدفع</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structure/virements">
                    <span class="material-symbols-outlined">list_alt</span>
                    <span>التحويلات البنكية</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committeeDashboard/viewOperations">
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
                <h2 class="text-xl font-bold">الطلبات المقبولة بانتظار الصرف</h2>
            </header>

            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <form action="<?= URLROOT; ?>/structure/pay" method="POST">
                    <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-stone-800 flex justify-between items-center bg-slate-50 dark:bg-stone-800/50">
                            <div class="flex items-center gap-4">
                                <h3 class="text-lg font-bold">تحديد الطلبات للصرف الجماعي</h3>
                                <span id="selectedCount" class="bg-primary text-white px-3 py-1 rounded-full text-xs font-bold">0 مختارة</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="space-y-1">
                                    <input type="number" name="total_fees" placeholder="مجموع الرسوم البنكية" class="rounded-xl border-slate-200 text-sm focus:ring-primary py-2 px-4" step="0.01" value="0">
                                </div>
                                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">send</span>
                                    <span>إنشاء قائمة الصرف</span>
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 text-sm">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold text-center w-16">
                                            <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-primary focus:ring-primary">
                                        </th>
                                        <th class="px-6 py-4 font-semibold">الموظف</th>
                                        <th class="px-6 py-4 font-semibold">المنحة</th>
                                        <th class="px-6 py-4 font-semibold">المبلغ (دج)</th>
                                        <th class="px-6 py-4 font-semibold text-left">الحساب البنكي</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                    <?php foreach( as ): ?>
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30 transition-colors">
                                        <td class="px-6 py-4 text-center">
                                            <input type="checkbox" name="request_ids[]" value="<?= ['id']; ?>" class="request-checkbox rounded border-slate-300 text-primary focus:ring-primary">
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-bold text-sm"><?= ['nom_ar'] . ' ' . ['prenom_ar']; ?></p>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500"><?= ['grant_name']; ?></td>
                                        <td class="px-6 py-4 font-bold text-sm"><?= number_format(['grant_amount'], 2); ?></td>
                                        <td class="px-6 py-4 text-sm text-slate-400 font-mono text-left"><?= ['num_compte']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.request-checkbox');
        const selectedCount = document.getElementById('selectedCount');

        function updateCount() {
            const count = document.querySelectorAll('.request-checkbox:checked').length;
            selectedCount.textContent = count + ' مختارة';
        }

        selectAll.addEventListener('change', () => {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateCount();
        });

        checkboxes.forEach(cb => cb.addEventListener('change', updateCount));
    </script>
</body>
</html>
