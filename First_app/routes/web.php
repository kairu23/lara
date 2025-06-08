<?php

use App\Http\Controllers\StudentsController;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/', [StudentsController::class, 'index'])->name('std.index');
Route::post('/create-student', [StudentsController::class, 'newStudent'])->name('std.create');
Route::delete('/students/{id}', [StudentsController::class, 'destroy'])->name('std.delete');
Route::put('/students/{id}', [StudentsController::class, 'update'])->name('std.update');