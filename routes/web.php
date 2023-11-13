<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HeadmasterController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');


// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Headmaster Routes
Route::group(['middleware' => 'role:headmaster'], function () {
    Route::get('headmaster', [HeadmasterController::class, 'index'])->name('headmaster.index');
    Route::post('headmaster/students', [StudentController::class, 'store'])->name('headmaster.students.store');
    Route::put('headmaster/students/{student}', [StudentController::class, 'update'])->name('headmaster.students.update');
    Route::delete('headmaster/students/{student}', [StudentController::class, 'destroy'])->name('headmaster.students.destroy');
    Route::get('registrar/students/{student}/print-fee-payment', [StudentController::class, 'headmasterprintFeePayment'])->name('headmaster.students.print-fee-payment');

});

// Registrar Routes
Route::group(['middleware' => 'role:registrar'], function () {
    Route::get('registrar', [RegistrarController::class, 'index'])->name('registrar.index');
    Route::put('registrar/{id}/update', [StudentController::class, 'updateStudentRecord'])->name('registrar.update');
    Route::get('registrar/{id}/print-fee-payment', [StudentController::class, 'printFeePayment'])->name('registrar.print-fee-payment');
});
