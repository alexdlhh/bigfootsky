<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ClientController;

Route::get('/', [HomeController::class, 'login'])->name('login');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/do_login', [HomeController::class, 'do_login'])->name('do_login');
Route::post('/do_register', [HomeController::class, 'do_register'])->name('do_register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/adminPanel', [HomeController::class, 'adminPanel'])->name('adminPanel');

    Route::get('/clients/{fullname?}/{dni?}/{email?}/{phone?}', [ClientController::class, 'index'])->name('clients');
    Route::get('/clientEdit/{id}', [ClientController::class, 'create'])->name('clientEdit');
    Route::post('/clientSave', [ClientController::class, 'save'])->name('clientSave');
    Route::post('/clientDelete', [ClientController::class, 'delete'])->name('clientDelete');

    Route::get('/products/{category?}/{status?}/{size?}/{quality?}', [ProductController::class, 'index'])->name('products');
    Route::get('/productEdit/{id}', [ProductController::class, 'create'])->name('productEdit');
    Route::post('/productSave', [ProductController::class, 'save'])->name('productSave');
    Route::post('/productDelete', [ProductController::class, 'delete'])->name('productDelete');

    Route::get('/rents/{date_start?}/{date_end?}/{client?}/{status?}', [RentController::class, 'index'])->name('rents');
    Route::get('/rentEdit/{id}', [RentController::class, 'create'])->name('rentEdit');
    Route::post('/rentSave', [RentController::class, 'save'])->name('rentSave');
    Route::post('/rentDelete', [RentController::class, 'delete'])->name('rentDelete');

    Route::get('/teachers/{name?}/{dni?}/{email?}/{phone?}', [TeacherController::class, 'index'])->name('teachers');
    Route::get('/teacherEdit/{id}', [TeacherController::class, 'create'])->name('teacherEdit');
    Route::post('/teacherSave', [TeacherController::class, 'save'])->name('teacherSave');
    Route::post('/teacherDelete', [TeacherController::class, 'delete'])->name('teacherDelete');

    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
});