import os
import re

views_dir = 'app/Views/admin'
standard_sidebar = """
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
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {dashboard_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/dashboard">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>لوحة التحكم الرئيسية</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {employees_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/employees">
                    <span class="material-symbols-outlined">group</span>
                    <span>إدارة الموظفين</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {mandates_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/mandates">
                    <span class="material-symbols-outlined">event_note</span>
                    <span>إدارة العهد</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {grants_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/grants">
                    <span class="material-symbols-outlined">account_balance</span>
                    <span>إدارة المنح</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {users_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/admin/users">
                    <span class="material-symbols-outlined">manage_accounts</span>
                    <span>إدارة المستخدمين</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {requests_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committee/requests">
                    <span class="material-symbols-outlined">assignment</span>
                    <span>دراسة الطلبات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {payments_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structure/payments">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                    <span>المدفوعات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {operations_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/committeeDashboard/viewOperations">
                    <span class="material-symbols-outlined">history</span>
                    <span>سجل العمليات</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl {deductions_active} transition-colors text-slate-700 dark:text-slate-300" href="<?= URLROOT; ?>/structureDashboard/deductions">
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
"""

active_class = "bg-primary text-white font-medium"
inactive_class = "hover:bg-primary/10"

mapping = {
    'dashboard.php': 'dashboard',
    'employees.php': 'employees',
    'mandates.php': 'mandates',
    'grants.php': 'grants',
    'users.php': 'users',
    'requests_study.php': 'requests',
    'payments.php': 'payments',
    'operations_view.php': 'operations',
    'deductions.php': 'deductions'
}

for filename, key in mapping.items():
    filepath = os.path.join(views_dir, filename)
    if not os.path.exists(filepath):
        continue

    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Replace the sidebar section
    context = {k + '_active': inactive_class for k in mapping.values()}
    context[key + '_active'] = active_class

    new_sidebar = standard_sidebar.format(**context)

    # Simple regex to find and replace <aside>...</aside>
    pattern = re.compile(r'<aside.*?</aside>', re.DOTALL)
    if pattern.search(content):
        updated_content = pattern.sub(new_sidebar, content)
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(updated_content)
        print(f"Updated {filename}")
    else:
        print(f"Could not find <aside> in {filename}")
