<?php

use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\StudioController as AdminStudioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;







// ─── ROTAS PÚBLICAS ───────────────────────────────────────
Route::get('/', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studios/{id}/games', [StudioController::class, 'show'])->name('studios.games');

// ─── ROTAS AUTENTICADAS ───────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
    Route::post('/games/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});




Route::get('/games/{id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

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
    Route::get('/games/{id}/edit', [AdminGameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{id}', [AdminGameController::class, 'update'])->name('games.update');
    Route::delete('/games/{id}', [AdminGameController::class, 'destroy'])->name('games.destroy');
});


Route::fallback(function () {
    return view('errors.404');
});
