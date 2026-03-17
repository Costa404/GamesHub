<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StudioController as AdminStudioController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ─── AUTENTICAÇÃO ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── ROTAS PÚBLICAS ───────────────────────────────────────
Route::get('/', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studios/{id}/games', [StudioController::class, 'show'])->name('studios.games');

// ─── ROTAS AUTENTICADAS ───────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');

});

// ─── ROTAS ADMIN ──────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/studios', [AdminStudioController::class, 'index'])->name('studios.index');
    Route::get('/studios/create', [AdminStudioController::class, 'create'])->name('studios.create');
    Route::post('/studios', [AdminStudioController::class, 'store'])->name('studios.store');
    Route::get('/studios/{id}/edit', [AdminStudioController::class, 'edit'])->name('studios.edit');
    Route::put('/studios/{id}', [AdminStudioController::class, 'update'])->name('studios.update');
    Route::delete('/studios/{id}', [AdminStudioController::class, 'destroy'])->name('studios.destroy');

    Route::get('/games/create', [AdminGameController::class, 'create'])->name('games.create');
    Route::post('/games', [AdminGameController::class, 'store'])->name('games.store');
    Route::delete('/games/{id}', [AdminGameController::class, 'destroy'])->name('games.destroy');

});
