<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpruntController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/livres', [BookController::class, 'index'])->name('livres.index');
Route::get('/livres/create', [BookController::class, 'create'])->name('livres.create');
Route::post('/livres', [BookController::class, 'store'])->name('livres.store');
Route::get('/livres/{livre}', [BookController::class, 'show'])->name('livres.show');
Route::get('/livres/{livre}/edit', [BookController::class, 'edit'])->name('livres.edit');
Route::post('/livres/{livre}/emprunter', [EmpruntController::class, 'emprunter'])->name('livres.emprunter');
Route::post('/livres/{livre}/retourner', [EmpruntController::class, 'returnBook'])->name('livres.retourner');
Route::put('/livres/{livre}', [BookController::class, 'update'])->name('livres.update');
Route::delete('/livres/{livre}', [BookController::class, 'destroy'])->name('livres.destroy');



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Vos routes d'administration ici
});

Auth::routes();
