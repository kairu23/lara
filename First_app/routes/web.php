<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;

//views
Route::get('/',[AuthController::class, 'index'])->name('auth.index');

//routewithmiddkeware
Route::middleware('auth')->group(function (){
Route::get('/stud-list', [StudentsController::class, 'index'])->name('std.index');
});

//users
Route::post('/create-student', [StudentsController::class, 'newStudent'])->name('std.create');
Route::delete('/del-studs/{id}', [StudentsController::class, 'destroy'])->name('std.destroy');
Route::put('/edit-studs/{id}', [StudentsController::class, 'edit'])->name('std.edit');

//authentication
Route::get('/register', [AuthController::class, 'registerView'])->name('auth.register');
Route::get('/login', [AuthController::class, 'loginView'])->name('auth.login');
Route::post('/user-registration', [AuthController::class, 'registerUser'])->name('registration');
Route::post('/user-login', [AuthController::class, 'loginUser'])->name('login');
Route::post('/user-logout', [AuthController::class, 'logoutUser'])->name('logout');