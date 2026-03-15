<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>بوابة الموظف</title>
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
                    <span class="material-symbols-outlined block">person</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight">بوابة الموظف</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?= $employee['nom_ar'] . ' ' . $employee['prenom_ar']; ?></p>
                </div>
            </div>
            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-medium" href="<?= URLROOT; ?>/portal/dashboard">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>الرئيسية</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="#">
                    <span class="material-symbols-outlined">assignment</span>
                    <span>طلباتي</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="#">
                    <span class="material-symbols-outlined">notifications</span>
                    <span>الإشعارات</span>
                </a>
                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-stone-800">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/portal/logout">
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
                    <h2 class="text-xl font-bold">لوحة التحكم</h2>
                </div>
                <div class="flex items-center gap-4">
                    <p class="text-xs font-medium text-slate-500"><?= date('Y-m-d'); ?></p>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <!-- Stats Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-primary rounded-2xl p-6 text-white shadow-lg shadow-primary/20 relative overflow-hidden">
                        <div class="relative z-10">
                            <p class="text-primary-100 text-xs opacity-90 mb-1">الرصيد المتاح للعهدة</p>
                            <h2 class="text-2xl font-bold"><?= $mandate ? number_format($mandate['budget'], 2) : '0.00'; ?> دج</h2>
                        </div>
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                    <div class="bg-white dark:bg-stone-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 flex flex-col justify-center text-center">
                        <span class="block text-2xl font-bold text-primary"><?= count(array_filter($requests, fn($r) => $r['status'] == 'pending')); ?></span>
                        <span class="text-xs text-slate-500 uppercase">طلبات معلقة</span>
                    </div>
                    <div class="bg-white dark:bg-stone-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 flex flex-col justify-center text-center">
                        <span class="block text-2xl font-bold text-primary"><?= count($grants); ?></span>
                        <span class="text-xs text-slate-500 uppercase">منحة متاحة</span>
                    </div>
                </div>

                <?php if(isset($_SESSION['success'])): ?>
                    <div class="p-4 bg-green-100 text-green-700 rounded-xl text-sm"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="p-4 bg-red-100 text-red-700 rounded-xl text-sm"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <!-- Grants Section -->
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">المنح المتاحة</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach($grants as $g): ?>
                        <div class="bg-white dark:bg-stone-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 flex flex-col items-center text-center transition-transform hover:scale-105">
                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-4 text-primary">
                                <span class="material-symbols-outlined text-4xl">
                                    <?= strpos(strtolower($g['name']), 'زواج') !== false ? 'favorite' :
                                       (strpos(strtolower($g['name']), 'سيارة') !== false ? 'directions_car' :
                                       (strpos(strtolower($g['name']), 'دراس') !== false ? 'school' : 'payments')); ?>
                                </span>
                            </div>
                            <h4 class="font-bold text-base mb-1"><?= $g['name']; ?></h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4"><?= number_format($g['amount'], 2); ?> دج</p>
                            <button onclick="openModal('modal<?= $g['id']; ?>')" class="w-full py-2 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">تقديم الطلب</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Recent Requests Section -->
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">طلباتي الأخيرة</h3>
                    </div>
                    <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-slate-100 dark:border-stone-800 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead class="bg-slate-50 dark:bg-stone-800/50 text-slate-500 text-sm uppercase">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">المنحة</th>
                                        <th class="px-6 py-4 font-semibold">التاريخ</th>
                                        <th class="px-6 py-4 font-semibold">الحالة</th>
                                        <th class="px-6 py-4 font-semibold">رقم الطلب</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
                                    <?php foreach($requests as $r): ?>
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-stone-800/30">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-stone-800 flex items-center justify-center text-slate-500">
                                                    <span class="material-symbols-outlined text-sm"><?= $r['status'] == 'beneficiary' ? 'verified' : 'description'; ?></span>
                                                </div>
                                                <span class="font-bold text-sm"><?= $r['grant_name']; ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500"><?= date('Y-m-d', strtotime($r['created_at'])); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-[10px] font-bold rounded-full
                                                <?= $r['status'] == 'beneficiary' ? 'bg-green-100 text-green-600' :
                                                   ($r['status'] == 'pending' ? 'bg-orange-100 text-orange-600' : 'bg-red-100 text-red-600'); ?>">
                                                <?= $r['status'] == 'pending' ? 'قيد الدراسة' : ($r['status'] == 'beneficiary' ? 'مستفيد' : 'مرفوض'); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-slate-400">#REQ-<?= $r['id']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <?php foreach($grants as $g): ?>
    <div id="modal<?= $g['id']; ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeModal('modal<?= $g['id']; ?>')">
                <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-stone-900 rounded-2xl text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-stone-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-6 border-b dark:border-stone-800 pb-4">
                        <h3 class="text-lg font-bold">تقديم طلب: <?= $g['name']; ?></h3>
                        <button onclick="closeModal('modal<?= $g['id']; ?>')" class="text-slate-400 hover:text-slate-600"><span class="material-symbols-outlined">close</span></button>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-primary/5 p-4 rounded-xl border border-primary/10">
                            <p class="text-sm font-bold text-primary mb-1">الشروط:</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400"><?= $g['conditions']; ?></p>
                        </div>
                        <div class="p-4 rounded-xl border border-slate-100 dark:border-stone-800">
                            <p class="text-sm font-bold mb-1">الوثائق المطلوبة:</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= $g['required_documents']; ?></p>
                        </div>
                        <form action="<?= URLROOT; ?>/portalDashboard/submitRequest" method="POST" enctype="multipart/form-data" class="space-y-6">
                            <input type="hidden" name="grant_id" value="<?= $g['id']; ?>">
                            <div class="border-2 border-dashed border-slate-200 dark:border-stone-700 hover:border-primary/50 transition-colors bg-slate-50 dark:bg-stone-800 rounded-2xl p-8 flex flex-col items-center justify-center text-center cursor-pointer relative">
                                <span class="material-symbols-outlined text-4xl text-primary mb-3">cloud_upload</span>
                                <p class="text-sm font-bold mb-1">اضغط لتحميل ملف PDF</p>
                                <p class="text-xs text-slate-400">الحد الأقصى 5 ميجابايت</p>
                                <input type="file" name="pdf" class="absolute inset-0 opacity-0 cursor-pointer" accept=".pdf" required onchange="updateFileName(this)">
                                <p id="fileName<?= $g['id']; ?>" class="text-xs text-primary font-bold mt-3 hidden"></p>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">إرسال الطلب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function updateFileName(input) {
            const id = input.closest('form').querySelector('input[name="grant_id"]').value;
            const fileNameDisplay = document.getElementById('fileName' + id);
            if (input.files[0]) {
                fileNameDisplay.textContent = 'الملف المختار: ' + input.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
