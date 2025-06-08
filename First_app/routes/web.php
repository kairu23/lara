<?php
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

// Display the student list
Route::get('/', [StudentsController::class, 'index'])->name('std.index');

// Create a new student
Route::post('/create-student', [StudentsController::class, 'newStudent'])->name('std.create');

// Update student details
Route::put('/update-student/{id}', [StudentsController::class, 'updateStudent'])->name('std.update');

// Delete a student
Route::delete('/delete-student/{id}', [StudentsController::class, 'deleteStudent'])->name('std.delete');