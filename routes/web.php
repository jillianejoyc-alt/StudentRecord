<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::redirect('/', '/dashboard');
Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
Route::resource('students', StudentController::class);
