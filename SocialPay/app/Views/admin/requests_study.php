<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>دراسة الطلبات</title>
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
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committee/requests">
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
            <header class="h-16 bg-white dark:bg-stone-900 border-b border-slate-200 dark:border-stone-800 flex items-center justify-between px-8 z-10 shadow-sm">
                <h2 class="text-xl font-bold">دراسة طلبات المنح والسلف</h2>
            </header>

            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 dark:text-slate-400 text-sm uppercase">
                                    <th class="px-6 py-4 font-semibold">الموظف</th>
                                    <th class="px-6 py-4 font-semibold">المنحة</th>
                                    <th class="px-6 py-4 font-semibold">الملف</th>
                                    <th class="px-6 py-4 font-semibold">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                <?php foreach($requests as $r): ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-sm"><?= $r['nom_ar'] . ' ' . $r['prenom_ar']; ?></p>
                                        <p class="text-[10px] text-slate-400"><?= $r['created_at']; ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><?= $r['grant_name']; ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="<?= URLROOT; ?>/<?= $r['file_path']; ?>" target="_blank" class="flex items-center gap-1 text-primary hover:underline">
                                            <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                                            <span>عرض PDF</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($_SESSION['role'] == 'chairman' && $r['status'] == 'pending'): ?>
                                        <form action="<?= URLROOT; ?>/committee/process" method="POST" class="flex gap-2 items-center">
                                            <input type="hidden" name="request_id" value="<?= $r['id']; ?>">
                                            <select name="status" class="rounded-lg border-slate-200 text-xs py-1 px-2 focus:ring-primary">
                                                <option value="beneficiary">موافقة</option>
                                                <option value="rejected_temp">رفض مؤقت</option>
                                                <option value="rejected_final">رفض نهائي</option>
                                            </select>
                                            <button type="submit" class="bg-primary text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-primary/90">حفظ</button>
                                        </form>
                                        <?php else: ?>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                            <?= $r['status'] == 'beneficiary' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?= $r['status']; ?>
                                        </span>
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
