<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\KuisionerController as AdminKuisionerController;
use App\Http\Controllers\Admin\SkripsiController as AdminSkripsiController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Alumni\KuisionerController as AlumniKuisionerController;
use App\Http\Controllers\Alumni\LowonganController as AlumniLowonganController;
use App\Http\Controllers\Alumni\ProfileController as AlumniProfileController;
use App\Http\Controllers\Alumni\SkripsiController as AlumniSkripsiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', AdminUserController::class);
        Route::resource('skripsi', AdminSkripsiController::class)->except(['create', 'store']);
        Route::resource('berita', AdminBeritaController::class);

        // Kuisioner routes
        Route::get('kuisioner', [AdminKuisionerController::class, 'index'])->name('kuisioner.index');
        Route::get('kuisioner/export', [AdminKuisionerController::class, 'export'])->name('kuisioner.export');
        Route::get('kuisioner/questions', [AdminKuisionerController::class, 'questions'])->name('kuisioner.questions');
        Route::get('kuisioner/questions/create', [AdminKuisionerController::class, 'createQuestion'])->name('kuisioner.questions.create');
        Route::post('kuisioner/questions', [AdminKuisionerController::class, 'storeQuestion'])->name('kuisioner.questions.store');
        Route::get('kuisioner/questions/{pertanyaan}/edit', [AdminKuisionerController::class, 'editQuestion'])->name('kuisioner.questions.edit');
        Route::patch('kuisioner/questions/{pertanyaan}', [AdminKuisionerController::class, 'updateQuestion'])->name('kuisioner.questions.update');
        Route::delete('kuisioner/questions/{pertanyaan}', [AdminKuisionerController::class, 'destroyQuestion'])->name('kuisioner.questions.destroy');
    });

    // Alumni Routes
    Route::middleware('role:alumni')->prefix('alumni')->name('alumni.')->group(function () {
        Route::get('/profile', [AlumniProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AlumniProfileController::class, 'update'])->name('profile.update');
        Route::resource('skripsi', AlumniSkripsiController::class);
        Route::resource('lowongan', AlumniLowonganController::class);

        // Kuisioner routes
        Route::get('kuisioner', [AlumniKuisionerController::class, 'index'])->name('kuisioner.index');
        Route::post('kuisioner', [AlumniKuisionerController::class, 'store'])->name('kuisioner.store');
    });
});
