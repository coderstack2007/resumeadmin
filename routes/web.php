<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumesController;
use Illuminate\Support\Facades\Route;

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

// Главная страница - перенаправление на логин
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard - перенаправление на resumes без middleware auth
Route::get('/dashboard', function () {
    return redirect()->route('resumes.index');
})->name('dashboard');

// Маршруты для резюме (без middleware auth, как вы просили)
Route::get('/resumes', [ResumesController::class, 'index'])->name('resumes.index');
Route::delete('/resumes/{id}', [ResumesController::class, 'destroy'])->name('resumes.destroy');


// Роуты для резюме
Route::prefix('resumes')->group(function () {
    Route::get('/', [ResumesController::class, 'index'])->name('resumes.index');
    Route::get('/{id}', [ResumesController::class, 'show'])->name('resumes.show');
    Route::delete('/{id}', [ResumesController::class, 'destroy'])->name('resumes.destroy');
    Route::get('/export/csv', [ResumesController::class, 'export'])->name('resumes.export');
});


// Стандартные маршруты аутентификации Laravel Breeze
require __DIR__.'/auth.php';