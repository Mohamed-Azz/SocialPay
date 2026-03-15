<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>بوابة الموظف</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;family=Noto+Sans+Arabic:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
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
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen font-display">
    <div class="max-w-md mx-auto bg-background-light dark:bg-background-dark min-h-screen flex flex-col pb-20">
        <!-- Header Section -->
        <header class="p-6 pt-8 bg-white dark:bg-slate-900/50 rounded-b-3xl shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-full border-2 border-primary p-0.5">
                            <?php if($employee['photo']): ?>
                                <img src="<?= $employee['photo']; ?>" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <span class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white dark:border-slate-900 rounded-full"></span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-white">أهلاً بك، <?= $employee['prenom_ar']; ?></h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400"><?= $employee['position'] ?? 'موظف'; ?></p>
                    </div>
                </div>
                <a href="<?= URLROOT; ?>/portal/logout" class="w-10 h-10 flex items-center justify-center rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
            <div class="bg-primary rounded-2xl p-4 text-white shadow-lg shadow-primary/20 relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-primary-100 text-xs opacity-90 mb-1">الرصيد المتاح للعهدة</p>
                    <h2 class="text-lg font-bold"><?= $mandate ? number_format($mandate['budget'], 2) : '0.00'; ?> دج</h2>
                    <div class="mt-3 flex gap-4">
                        <div class="bg-white/20 rounded-lg p-2 flex-1 text-center">
                            <span class="block text-xl font-bold"><?= count(array_filter($requests, fn($r) => $r['status'] == 'pending')); ?></span>
                            <span class="text-[10px] uppercase">طلبات معلقة</span>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2 flex-1 text-center">
                            <span class="block text-xl font-bold"><?= count($grants); ?></span>
                            <span class="text-[10px] uppercase">منحة متاحة</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
            </div>
        </header>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="mx-6 mt-4 p-4 bg-green-100 text-green-700 rounded-xl text-sm"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="mx-6 mt-4 p-4 bg-red-100 text-red-700 rounded-xl text-sm"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Grants Section -->
        <section class="mt-8 px-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">المنح المتاحة</h3>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                <?php foreach($grants as $g): ?>
                <div class="min-w-[160px] bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-3 text-primary">
                        <span class="material-symbols-outlined text-3xl">
                            <?= strpos(strtolower($g['name']), 'زواج') !== false ? 'favorite' :
                               (strpos(strtolower($g['name']), 'سيارة') !== false ? 'directions_car' :
                               (strpos(strtolower($g['name']), 'دراس') !== false ? 'school' : 'payments')); ?>
                        </span>
                    </div>
                    <h4 class="font-bold text-sm mb-1"><?= $g['name']; ?></h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?= number_format($g['amount'], 2); ?> دج</p>
                    <button onclick="openModal('modal<?= $g['id']; ?>')" class="mt-3 w-full py-1.5 bg-primary/5 text-primary text-xs font-bold rounded-lg hover:bg-primary hover:text-white transition-colors">تقديم</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Recent Requests Section -->
        <section class="mt-4 px-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">طلباتي الأخيرة</h3>
            </div>
            <div class="space-y-3">
                <?php foreach($requests as $r): ?>
                <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined"><?= $r['status'] == 'beneficiary' ? 'verified' : 'description'; ?></span>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm"><?= $r['grant_name']; ?></h5>
                            <p class="text-[10px] text-slate-400">بتاريخ: <?= date('Y-m-d', strtotime($r['created_at'])); ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <span class="px-3 py-1 text-[10px] font-bold rounded-full
                            <?= $r['status'] == 'beneficiary' ? 'bg-green-100 text-green-600' :
                               ($r['status'] == 'pending' ? 'bg-orange-100 text-orange-600' : 'bg-red-100 text-red-600'); ?>">
                            <?= $r['status'] == 'pending' ? 'قيد الدراسة' : ($r['status'] == 'beneficiary' ? 'مستفيد' : 'مرفوض'); ?>
                        </span>
                        <span class="text-[10px] text-slate-400 font-medium">#REQ-<?= $r['id']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Modals -->
        <?php foreach($grants as $g): ?>
        <div id="modal<?= $g['id']; ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
                </div>
                <div class="inline-block align-bottom bg-white dark:bg-background-dark rounded-t-3xl text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-background-dark px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4 border-b pb-4">
                            <h3 class="text-lg font-bold">تقديم طلب: <?= $g['name']; ?></h3>
                            <button onclick="closeModal('modal<?= $g['id']; ?>')" class="text-slate-400"><span class="material-symbols-outlined">close</span></button>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-primary/10 p-4 rounded-xl">
                                <p class="text-sm font-bold text-primary mb-1">الشروط:</p>
                                <p class="text-xs text-slate-600"><?= $g['conditions']; ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-bold mb-1">الوثائق المطلوبة:</p>
                                <p class="text-xs text-slate-500"><?= $g['required_documents']; ?></p>
                            </div>
                            <form action="<?= URLROOT; ?>/portalDashboard/submitRequest" method="POST" enctype="multipart/form-data" class="space-y-4">
                                <input type="hidden" name="grant_id" value="<?= $g['id']; ?>">
                                <div class="border-2 border-dashed border-primary/30 bg-primary/5 rounded-xl p-6 flex flex-col items-center justify-center text-center cursor-pointer relative">
                                    <span class="material-symbols-outlined text-3xl text-primary mb-2">cloud_upload</span>
                                    <p class="text-sm font-bold">اضغط لتحميل ملف PDF</p>
                                    <input type="file" name="pdf" class="absolute inset-0 opacity-0 cursor-pointer" accept=".pdf" required onchange="updateFileName(this)">
                                    <p id="fileName<?= $g['id']; ?>" class="text-xs text-slate-500 mt-2">لا يوجد ملف مختار</p>
                                </div>
                                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/20">تأكيد وإرسال الطلب</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 px-6 py-3 flex justify-between items-center z-50">
            <a class="flex flex-col items-center gap-1 text-primary" href="#">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
                <span class="text-[10px] font-bold">الرئيسية</span>
            </a>
            <a class="flex flex-col items-center gap-1 text-slate-400 dark:text-slate-500" href="#">
                <span class="material-symbols-outlined">assignment</span>
                <span class="text-[10px] font-medium">طلباتي</span>
            </a>
            <a class="flex flex-col items-center gap-1 text-slate-400 dark:text-slate-500 relative" href="#">
                <span class="material-symbols-outlined">notifications</span>
                <span class="text-[10px] font-medium">الإشعارات</span>
                <span class="absolute top-0 right-1 w-2 h-2 bg-primary rounded-full border-2 border-white dark:border-slate-900"></span>
            </a>
            <a class="flex flex-col items-center gap-1 text-slate-400 dark:text-slate-500" href="#">
                <span class="material-symbols-outlined">person</span>
                <span class="text-[10px] font-medium">الملف</span>
            </a>
        </nav>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function updateFileName(input) {
            const id = input.closest('form').querySelector('input[name="grant_id"]').value;
            const fileName = input.files[0] ? input.files[0].name : 'لا يوجد ملف مختار';
            document.getElementById('fileName' + id).textContent = fileName;
        }
    </script>
</body>
</html>
