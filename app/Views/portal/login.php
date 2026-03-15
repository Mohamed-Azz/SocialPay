<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>تسجيل دخول الموظف</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;family=Noto+Sans+Arabic:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
                        "display": ["Noto Sans Arabic", "Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Arabic', 'Public Sans', sans-serif;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display">
    <div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden">
        <header class="flex items-center p-4 justify-between bg-transparent">
            <div class="text-slate-900 dark:text-slate-100 flex size-12 shrink-0 items-center justify-center cursor-pointer">
                <span class="material-symbols-outlined">arrow_forward</span>
            </div>
            <div class="flex-1 text-center pr-12">
                <h1 class="text-slate-900 dark:text-slate-100 text-lg font-bold leading-tight tracking-tight">تسجيل دخول الموظف</h1>
            </div>
        </header>
        <main class="flex-1 flex flex-col px-6 pb-12">
            <div class="flex justify-center py-10">
                <div class="w-32 h-32 bg-primary/10 rounded-full flex items-center justify-center">
                    <div class="w-24 h-24 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBKDWDA-NqC-NJndGKpUHvhW6vkxqY6oQKsl1isfMiHFxDmaNBtHdi96_5b6kWBw-J6G4Yk8IzgrzE8TaGm_HGT0OmBslKWwIm_TyIauLWu_2J3XnaUpsGsVJNcGrwuQ1CBcq6W8ELTO_6Am3sMiGMU356u0ybNmRyw9VSjUhZ5Nhfq4fAkCJUp8-173agNi81J4BZd0Cepwoj7WlI5lPBS5xAzn3iuhk9629tpEs1URW4T83mF-kgZzZuS_APtChk7qXy8wN-hzqE')"></div>
                </div>
            </div>
            <div class="text-center mb-8">
                <h2 class="text-slate-900 dark:text-slate-100 text-3xl font-bold leading-tight mb-2">مرحباً بك</h2>
                <p class="text-slate-600 dark:text-slate-400 text-base font-normal">يرجى إدخال البيانات التالية للوصول إلى حسابك الوظيفي</p>
            </div>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="max-w-md mx-auto w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span class="block sm:inline"><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= URLROOT; ?>/portal/auth" method="POST" class="space-y-6 max-w-md mx-auto w-full">
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col w-full">
                        <span class="text-slate-800 dark:text-slate-200 text-base font-medium pb-2">رقم الضمان الاجتماعي</span>
                        <div class="relative">
                            <input name="ssn" class="form-input flex w-full rounded-xl text-slate-900 dark:text-slate-100 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 h-14 placeholder:text-slate-400 p-4 text-left tracking-widest" maxlength="12" placeholder="000000000000" type="text" required/>
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">badge</span>
                        </div>
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col w-full">
                        <span class="text-slate-800 dark:text-slate-200 text-base font-medium pb-2">تاريخ الميلاد</span>
                        <div class="relative">
                            <input name="dob" class="form-input flex w-full rounded-xl text-slate-900 dark:text-slate-100 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 h-14 placeholder:text-slate-400 p-4 text-right" type="text" placeholder="مثال: 10021999" maxlength="8" required/>
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">calendar_month</span>
                        </div>
                    </label>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold text-lg h-14 rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2">
                        <span>دخول</span>
                        <span class="material-symbols-outlined">login</span>
                    </button>
                </div>
                <div class="flex flex-col items-center gap-4 pt-6">
                    <a href="<?= URLROOT; ?>/auth/login" class="text-primary font-medium hover:underline">دخول الإدارة (اللجنة / التسيير)</a>
                    <div class="h-px w-full bg-slate-200 dark:bg-slate-800"></div>
                    <p class="text-slate-500 dark:text-slate-500 text-sm text-center">
                        تواجه مشكلة؟ <a class="text-primary font-semibold" href="#">تواصل مع الدعم الفني</a>
                    </p>
                </div>
            </form>
        </main>
        <footer class="p-6 text-center">
            <p class="text-slate-400 dark:text-slate-600 text-xs mt-4">جميع الحقوق محفوظة للمؤسسة العامة © 2024</p>
        </footer>
        <div class="fixed top-0 left-0 w-full h-1 bg-gradient-to-l from-primary via-primary/50 to-transparent"></div>
    </div>
</body>
</html>
