<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ClientPasswordController;
use App\Http\Controllers\Admin\ProjectVisitController;
use App\Http\Controllers\Admin\BlockUploadController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\SecurityCodeController;
use Illuminate\Support\Facades\Route;

// Security Code Routes
Route::get('/security-code', [SecurityCodeController::class, 'show'])->name('security.code');
Route::post('/security-code', [SecurityCodeController::class, 'verify'])->name('security.verify');

// Frontend Routes (protected by security code)
Route::middleware('security.code')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/case-studies', [ProjectController::class, 'index'])->name('case-studies');
    Route::get('/project/{slug}', [ProjectController::class, 'show'])->name('project.show');
    Route::post('/project/{slug}/verify-password', [ProjectController::class, 'verifyPassword'])->name('project.verify-password');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // Client Authentication
    Route::get('/client-login', [ClientAuthController::class, 'showLogin'])->name('client.login');
    Route::post('/client-login', [ClientAuthController::class, 'login'])->name('client.login.submit');
    Route::get('/client-logout', [ClientAuthController::class, 'logout'])->name('client.logout');
});

// Admin Routes (authenticated + security code)
Route::middleware(['security.code', 'auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', AdminProjectController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::resource('client-passwords', ClientPasswordController::class)->except(['show']);

    Route::get('/project-visits', [ProjectVisitController::class, 'index'])->name('project-visits.index');
    Route::delete('/project-visits/{projectVisit}', [ProjectVisitController::class, 'destroy'])->name('project-visits.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Block upload routes
    Route::post('/blocks/upload', [BlockUploadController::class, 'upload'])->name('blocks.upload');
    Route::delete('/blocks/delete', [BlockUploadController::class, 'delete'])->name('blocks.delete');
});

// Auth Routes (protected by security code)
Route::middleware(['security.code', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
