<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssistController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\LogCrudController;
use App\Http\Controllers\LogController;
use App\Http\Resources\Student;
use App\Models\Assist;
use App\Models\LogCrud;
use App\Models\Parameter;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::get('details', [ProductController::class, 'details']);
    Route::get('outJson', [ProductController::class, 'outJson']);
    Route::get('assistance', [ProductController::class, 'assistance']);
    Route::post('insertProduct', [ProductController::class, 'insertProduct']);
    
    Route::resource('students', StudentController::class);
    Route::post('students/filter', [StudentController::class, 'filter'])->name('students.filter');
    Route::get('students/{student}/pdf', [StudentController::class, 'downloadPDF'])->name('students.downloadPDF');
    Route::get('students/{id}/downloadExcel', [StudentController::class, 'downloadExcel'])->name('students.downloadExcel');


    Route::get('assist/{student}/student', [AssistController::class, 'show'])->name('assist.show');
    Route::get('assist/menu', [AssistController::class, 'menu'])->name('assist.menu');
    Route::post('assist/search', [AssistController::class, 'search'])->name('assist.search');
    Route::post('assist/store', [AssistController::class, 'store'])->name('assist.store');

    Route::get('logCrud', [LogCrudController::class, 'show'])->name('logCrud.show');

    Route::resource('parameters', ParameterController::class);
});

require __DIR__.'/auth.php';