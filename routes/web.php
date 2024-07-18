<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;



Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'admin_logout']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index']);

    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/category/{id}/show', [CategoryController::class, 'show']);
    Route::get('/admin/category/delete', [CategoryController::class, 'destroy']);
    Route::post('/admin/category/create', [CategoryController::class, 'store']);
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::post('/admin/category/{id}/update', [CategoryController::class, 'update']);

    Route::get('/admin/posts', [PostController::class, 'index']);
    Route::get('/admin/{slug}', [PostController::class, 'filterPostBySlugCate']);
    Route::get('/admin/post/{id}/show', [PostController::class, 'show']);
    Route::get('/admin/post/delete', [PostController::class, 'destroy']);
    Route::post('/admin/post/create', [PostController::class, 'store']);
    Route::get('/admin/post/{id}/edit', [PostController::class, 'edit']);
    Route::post('/admin/post/{id}/update', [PostController::class, 'update']);
});

Route::get('/', [IndexController::class, 'index']);
Route::post('login_user', [AuthController::class, 'auth_login_client']);
Route::get('logout_user', [AuthController::class, 'logout_user']);
Route::post('register_user', [AuthController::class, 'auth_register_client']);
Route::post('forgot_password', [AuthController::class, 'forgot_password_client']);

Route::get('reset/{token}', [AuthController::class, 'reset_password']);
Route::post('reset', [AuthController::class, 'update_password']);

Route::get('activate/{id}', [AuthController::class, 'activateMail']);

Route::get('shop', [IndexController::class, 'fullPost']);
Route::get('search', [IndexController::class, 'getPostsSearch']);
Route::get('/{slug}', [IndexController::class, 'shop']);
