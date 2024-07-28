<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

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
    Route::get('/bookss', [BookController::class, 'index2']);
    Route::get('/booksFilter', [BookController::class, 'indexFilter']);
    Route::get('/bookView/{id}',  [BookController::class, 'viewEdit']); 
    Route::get('books',  [BookController::class, 'index']);
    Route::post('books',  [BookController::class, 'store']);
    Route::delete('books',  [BookController::class, 'destroy']);


    Route::get('/categoriess', [CategoryController::class, 'index2']);
    Route::get('/categoryView/{id}',  [CategoryController::class, 'viewEdit']); 
    Route::get('categories',  [CategoryController::class, 'index']);
    Route::post('categories',  [CategoryController::class, 'store']);
    Route::delete('categories',  [CategoryController::class, 'destroy']);


});

require __DIR__.'/auth.php';
