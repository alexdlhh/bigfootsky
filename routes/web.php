<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ParticularController;
use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RepairController;


Route::get('/', [HomeController::class, 'login'])->name('login');

//paso 1 de reserva, registramos los usuarios
Route::get('/reserva', [HomeController::class, 'reserva'])->name('reserva');
//guardamos los usuarios en bbdd, será llamado por ajax
Route::post('/guardar-step1', [HomeController::class, 'saveStep1'])->name('saveStep1');
//paso 2 de reserva, seleccionamos los productos
Route::get('/reserva-step2', [HomeController::class, 'step2'])->name('step2');
//guardamos los productos en bbdd, será llamado por ajax
Route::post('/guardar-step2', [HomeController::class, 'saveStep2'])->name('saveStep2');
//ultimo paso, confirmamos la reserva y mostramos el resumen junto a un mensaje de gracias
Route::get('/reserva-thanks', [HomeController::class, 'thanks'])->name('thanks');
<<<<<<< HEAD
Route::get('/factura', [HomeController::class, 'factura'])->name('factura');

//vas a tener que crear 4 funciones nuevas en HomeController, 2 que van a ir a una view y otras 2 que son para guardar los datos en bbdd
=======
Route::get('/syncRent/{id}', [HomeController::class, 'syncRent'])->name('syncRent');
Route::get('/firma/{id}', [HomeController::class, 'firma'])->name('firma');
Route::post('/guardar-firma', [HomeController::class, 'saveFirma'])->name('saveFirma');
>>>>>>> 285e5577de4e4184e5bd06f12f6b3e877f8827b9

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
    Route::post('/signaturePad', [ClientController::class, 'signaturePad'])->name('signaturePad');

    Route::get('/products/{category?}/{status?}/{size?}/{quality?}', [ProductController::class, 'index'])->name('products');
    Route::get('/productEdit/{id}', [ProductController::class, 'create'])->name('productEdit');
    Route::post('/productSave', [ProductController::class, 'save'])->name('productSave');
    Route::post('/productDelete', [ProductController::class, 'delete'])->name('productDelete');
    Route::post('/priceCalculator', [RentController::class, 'priceCalculator'])->name('priceCalculator');

    Route::get('/rents/{date_start?}/{date_end?}/{client?}/{status?}', [RentController::class, 'index'])->name('rents');
    Route::get('/rentEdit/{id}', [RentController::class, 'create'])->name('rentEdit');
    Route::post('/rentSave', [RentController::class, 'save'])->name('rentSave');
    Route::post('/rentDelete', [RentController::class, 'delete'])->name('rentDelete');

    Route::get('/teachers/{name?}/{dni?}/{email?}/{phone?}', [TeacherController::class, 'index'])->name('teachers');
    Route::get('/teacherEdit/{id}', [TeacherController::class, 'create'])->name('teacherEdit');
    Route::post('/teacherSave', [TeacherController::class, 'save'])->name('teacherSave');
    Route::post('/teacherDelete', [TeacherController::class, 'delete'])->name('teacherDelete');

    Route::get('/courses/{name?}/{dni?}/{email?}/{phone?}', [CourseController::class, 'index'])->name('courses');
    Route::get('/courseEdit/{id}', [CourseController::class, 'create'])->name('courseEdit');
    Route::post('/courseSave', [CourseController::class, 'save'])->name('courseSave');
    Route::post('/courseDelete', [CourseController::class, 'delete'])->name('courseDelete');

    Route::get('/particulars/{name?}/{dni?}/{email?}/{phone?}', [ParticularController::class, 'index'])->name('particulars');
    Route::get('/particularEdit/{id}', [ParticularController::class, 'create'])->name('particularEdit');
    Route::post('/particularSave', [ParticularController::class, 'save'])->name('particularSave');
    Route::post('/particularDelete', [ParticularController::class, 'delete'])->name('particularDelete');
    
    Route::get('/colaborators/{name?}/{dni?}/{email?}/{phone?}', [ColaboratorsController::class, 'index'])->name('colaborators');
    Route::get('/colaboratorsEdit/{id}', [ColaboratorsController::class, 'create'])->name('colaboratorsEdit');
    Route::post('/colaboratorsSave', [ColaboratorsController::class, 'save'])->name('colaboratorsSave');
    Route::post('/colaboratorsDelete', [ColaboratorsController::class, 'delete'])->name('colaboratorsDelete');

    Route::get('/category/{name?}/{dni?}/{email?}/{phone?}', [CategoryController::class, 'index'])->name('category');
    Route::get('/categoryEdit/{id}', [CategoryController::class, 'create'])->name('categoryEdit');
    Route::post('/categorySave', [CategoryController::class, 'save'])->name('categorySave');
    Route::post('/categoryDelete', [CategoryController::class, 'delete'])->name('categoryDelete');

    Route::get('/repair/{name?}/{dni?}/{email?}/{phone?}', [RepairController::class, 'index'])->name('repair');
    Route::get('/repairEdit/{id}', [RepairController::class, 'create'])->name('repairEdit');
    Route::post('/repairSave', [RepairController::class, 'save'])->name('repairSave');
    Route::post('/repairDelete', [RepairController::class, 'delete'])->name('repairDelete');


    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
}); 