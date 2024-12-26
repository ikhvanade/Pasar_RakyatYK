<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\UserFormController;
use App\Http\Controllers\Admin\MarketController as AdminMarketController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rute untuk pengguna umum (tanpa login)
Route::get('/', [MarketController::class, 'index'])->name('home');
Route::get('/markets/{market}', [MarketController::class, 'show'])->name('markets.show');
Route::get('/markets/search', [MarketController::class, 'search'])->name('markets.search');

// Rute untuk pengajuan form user
Route::prefix('userform')->group(function () {
    Route::get('/form', [UserFormController::class, 'index'])->name('userform.form');
    Route::post('/form', [UserFormController::class, 'submit'])->name('userform.submit');

    Route::get('/search', function() {
        return view('userform.search');
    })->name('userform.search');
    Route::post('/search', [UserFormController::class, 'search'])->name('userform.search.result');
});


// Rute Admin hanya bisa diakses oleh Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-pedagang', [DashboardController::class, 'exportPedagang'])->name('export.pedagang');
    Route::get('/dashboard/export-umum', [DashboardController::class, 'exportUmum'])->name('export.umum');

    // Rute untuk profil pengguna admin
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Rute admin untuk mengelola pasar
    Route::resource('markets', AdminMarketController::class)->names([
        'index' => 'admin.markets.index',
        'show' => 'admin.markets.show',
        'create' => 'admin.markets.create',
        'store' => 'admin.markets.store',
        'edit' => 'admin.markets.edit',
        'update' => 'admin.markets.update',
        'destroy' => 'admin.markets.destroy',
    ]);

    // Rute admin untuk mengelola form pengajuan
    Route::get('forms/{type}/{id}/show', [FormController::class, 'show'])->name('admin.forms.show');
    Route::get('forms/{type}/{id}/edit', [FormController::class, 'edit'])->name('admin.forms.edit');
    Route::delete('forms/{type}/{id}/destroy', [FormController::class, 'destroy'])->name('admin.forms.destroy');
    Route::put('forms/{type}/{id}/update', [FormController::class, 'update'])->name('admin.forms.update');

    Route::resource('forms', FormController::class)->names([
        'index' => 'admin.forms.index',
])->except(['create', 'store', 'show', 'edit', 'destroy']);
});

// Mengimpor rute autentikasi (Laravel default)
require __DIR__ . '/auth.php';
