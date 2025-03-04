<?php

use App\Http\Controllers\VideosManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;



Route::get('/', [VideosController::class, 'index'])->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth', 'can:video_manager'])->group(function () {
        Route::get('/videos_manage', [VideosManagerController::class, 'index'])->name('manage.index');
        Route::get('/videos_manage/create', [VideosManagerController::class, 'create'])->name('manage.create');
        Route::post('/videos_manage', [VideosManagerController::class, 'store'])->name('manage.store');
        Route::get('/videos_manage/{id}/edit', [VideosManagerController::class, 'edit'])->name('manage.edit');
        Route::put('/videos_manage/{id}', [VideosManagerController::class, 'update'])->name('manage.update');
        Route::get('/videos_manage/{id}/delete', [VideosManagerController::class, 'delete'])->name('manage.delete');
        Route::delete('/videos_manage/{id}', [VideosManagerController::class, 'destroy'])->name('manage.destroy');
    });
});
Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
