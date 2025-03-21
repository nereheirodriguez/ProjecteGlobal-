<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('users_list', [UsersController::class, 'index'])->name('users.index');
        Route::get('/user_show/{id}', [UsersController::class, 'show'])->name('users.show');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth', 'can:super_admin'])->group(function () {
        Route::get('/users/manage', [UsersManageController::class, 'index'])->name('users.manage.index');
        Route::get('/users/manage/create', [UsersManageController::class, 'create'])->name('users.manage.create');
        Route::post('/users/manage', [UsersManageController::class, 'store'])->name('users.manage.store');
        Route::get('/users/manage/{id}/edit', [UsersManageController::class, 'edit'])->name('users.manage.edit');
        Route::put('/users/manage/{id}', [UsersManageController::class, 'update'])->name('users.manage.update');
        Route::get('/users/manage/{id}/delete', [UsersManageController::class, 'delete'])->name('users.manage.delete');
        Route::delete('/users/manage/{id}', [UsersManageController::class, 'destroy'])->name('users.manage.destroy');
    });
});

