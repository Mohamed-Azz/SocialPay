<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>إدارة الموظفين</title>
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
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/employees">
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
            <!-- Header -->
            <header class="h-16 bg-white dark:bg-stone-900 border-b border-slate-200 dark:border-stone-800 flex items-center justify-between px-8 z-10 shadow-sm">
                <div class="flex items-center gap-4 flex-1">
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        <input class="w-full pr-10 pl-4 py-2 rounded-xl bg-slate-100 dark:bg-stone-800 border-none focus:ring-2 focus:ring-primary/50 text-sm" placeholder="بحث عن موظف..." type="text"/>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white">إدارة الموظفين والعمال</h2>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">تتبع، إضافة، وإدارة ملفات الموظفين</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="<?= URLROOT; ?>/admin/import" method="POST" enctype="multipart/form-data" class="flex gap-2">
                            <input type="file" name="file" class="hidden" id="importFile" onchange="this.form.submit()" required>
                            <label for="importFile" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-stone-900 border border-slate-200 dark:border-stone-800 hover:bg-slate-50 cursor-pointer transition-colors font-semibold text-sm text-green-600">
                                <span class="material-symbols-outlined">upload_file</span>
                                <span>رفع CSV</span>
                            </label>
                        </form>
                        <button class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary text-white hover:bg-primary/90 transition-colors font-bold shadow-lg shadow-primary/20 text-sm">
                            <span class="material-symbols-outlined">person_add</span>
                            <span>إضافة موظف</span>
                        </button>
                    </div>
                </div>

                <!-- Employees Table -->
                <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-stone-800 flex justify-between items-center">
                        <h3 class="text-lg font-bold">قائمة الموظفين</h3>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-slate-50 dark:hover:bg-stone-800 rounded-lg text-slate-400">
                                <span class="material-symbols-outlined">filter_list</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 dark:text-slate-400 text-sm uppercase">
                                    <th class="px-6 py-4 font-semibold">الموظف</th>
                                    <th class="px-6 py-4 font-semibold">الماتريكول</th>
                                    <th class="px-6 py-4 font-semibold">رقم الضمان</th>
                                    <th class="px-6 py-4 font-semibold">الهيكل</th>
                                    <th class="px-6 py-4 font-semibold">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                <?php foreach($employees as $emp): ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                                                <?= mb_substr($emp['nom_ar'], 0, 1) . ' ' . mb_substr($emp['prenom_ar'], 0, 1); ?>
                                            </div>
                                            <div>
                                                <p class="font-bold text-sm"><?= $emp['nom_ar'] . ' ' . $emp['prenom_ar']; ?></p>
                                                <p class="text-xs text-slate-400"><?= $emp['position'] ?? 'موظف'; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium"><?= $emp['matricule']; ?></td>
                                    <td class="px-6 py-4 text-sm"><?= $emp['ssn']; ?></td>
                                    <td class="px-6 py-4 text-sm font-bold text-slate-600"><?= $emp['structure']; ?></td>
                                    <td class="px-6 py-4">
                                        <button class="text-slate-400 hover:text-primary"><span class="material-symbols-outlined">edit</span></button>
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
