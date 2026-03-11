<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Employee\AuthController as EmployeeAuthController;
use App\Http\Controllers\Employee\PortalController as EmployeePortalController;
use App\Http\Controllers\Committee\RequestController as CommitteeRequestController;
use App\Http\Controllers\Structure\PaymentController as StructurePaymentController;

Route::get('/', function () {
    return redirect()->route('employee.login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Committee Routes
Route::prefix('committee')->name('committee.')->middleware(['auth', 'role:chairman,member,university_manager'])->group(function() {
    Route::get('/requests', [CommitteeRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests/{serviceRequest}/process', [CommitteeRequestController::class, 'process'])->name('requests.process');
});

// Structure Routes
Route::prefix('structure')->name('structure.')->middleware(['auth', 'role:accountant,manager,chairman,university_manager'])->group(function() {
    Route::get('/payments', [StructurePaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/history', [StructurePaymentController::class, 'history'])->name('payments.history');
    Route::post('/payments/{serviceRequest}/process', [StructurePaymentController::class, 'processPayment'])->name('payments.process');
    Route::get('/payments/{payment}/txt', [StructurePaymentController::class, 'downloadTxt'])->name('payments.txt');
    Route::get('/payments/{payment}/pdf', [StructurePaymentController::class, 'downloadPdf'])->name('payments.pdf');
    Route::get('/deductions', [StructurePaymentController::class, 'monthlyDeductions'])->name('payments.deductions');
    Route::post('/installments/{installment}/pay', [StructurePaymentController::class, 'markPaid'])->name('payments.mark_paid');
});

// Admin Routes
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Mandates
    Route::get('/mandates', [MandateController::class, 'index'])->name('mandates.index');
    Route::post('/mandates', [MandateController::class, 'store'])->name('mandates.store');
    Route::post('/mandates/{mandate}/activate', [MandateController::class, 'activate'])->name('mandates.activate');

    // Babs & Grants
    Route::get('/babs', [\App\Http\Controllers\Admin\BabController::class, 'index'])->name('babs.index');
    Route::post('/babs', [\App\Http\Controllers\Admin\BabController::class, 'store'])->name('babs.store');
    Route::delete('/babs/{bab}', [\App\Http\Controllers\Admin\BabController::class, 'destroy'])->name('babs.destroy');

    Route::get('/grants', [\App\Http\Controllers\Admin\GrantController::class, 'index'])->name('grants.index');
    Route::post('/grants', [\App\Http\Controllers\Admin\GrantController::class, 'store'])->name('grants.store');
    Route::delete('/grants/{grant}', [\App\Http\Controllers\Admin\GrantController::class, 'destroy'])->name('grants.destroy');
});

// Employee Routes
Route::prefix('portal')->name('employee.')->group(function() {
    Route::get('/login', [EmployeeAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [EmployeeAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('logout');

    Route::get('/', [EmployeePortalController::class, 'index'])->name('portal.index');
    Route::post('/request', [EmployeePortalController::class, 'storeRequest'])->name('request.post');
});
