<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;

Route::get('/', [VideosController::class, 'index'])->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/notifications', function () {
    return view('notifications');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth', 'can:serie_manager'])->group(function () {
        Route::get('/series_manage', [SeriesManageController::class, 'index'])->name('series.manage.index');
        Route::get('/series_manage/create', [SeriesManageController::class, 'create'])->name('series.manage.create');
        Route::post('/series_manage', [SeriesManageController::class, 'store'])->name('series.manage.store');
        Route::get('/series_manage/{id}/edit', [SeriesManageController::class, 'edit'])->name('series.manage.edit');
        Route::put('/series_manage/{id}', [SeriesManageController::class, 'update'])->name('series.manage.update');
        Route::get('/series_manage/{id}/delete', [SeriesManageController::class, 'delete'])->name('series.manage.delete');
        Route::delete('/series_manage/{id}', [SeriesManageController::class, 'destroy'])->name('series.manage.destroy');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/series/create', [SeriesManageController::class, 'create'])->name('series.create');
        Route::post('/series', [SeriesManageController::class, 'store'])->name('series.store');
        Route::get('/series/{id}/edit', [SeriesManageController::class, 'edit'])->name('series.edit');
        Route::put('/series/{id}', [SeriesManageController::class, 'update'])->name('series.update');
        Route::get('/series/{id}/delete', [SeriesManageController::class, 'delete'])->name('series.delete');
        Route::delete('/series/{id}', [SeriesManageController::class, 'destroy'])->name('series.destroy');
    });
});

Route::get('/series/{id}', [SeriesController::class, 'show'])->name('serie.show');
Route::get('/series', [SeriesController::class, 'index'])->name('serie.index');



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

        Route::get('/user_videos_manage/create', [VideosController::class, 'create'])->name('manage.user.create');
        Route::post('/user_videos_manage', [VideosController::class, 'store'])->name('manage.user.store');
        Route::get('/user_videos_manage/{id}/edit', [VideosController::class, 'edit'])->name('manage.user.edit');
        Route::put('/user_videos_manage/{id}', [VideosController::class, 'update'])->name('manage.user.update');
        Route::get('/user_videos_manage/{id}/delete', [VideosController::class, 'delete'])->name('manage.user.delete');
        Route::delete('/user_videos_manage/{id}', [VideosController::class, 'destroy'])->name('manage.user.destroy');
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

