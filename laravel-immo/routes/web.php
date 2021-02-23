<?php

use App\Http\Controllers\Admin\AnnonceController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')->group(function() {
    Route::name('main_')->group(function() {
        // homepage
        Route::get('/', [MainController::class, 'browse'])->name('browse');
    });
});

// ADMIN pour le crud Annonce
Route::prefix('admin/annonces')->group(function() {
    Route::name('admin_annonces_')->group(function () {
        // page index
        Route::get('/', [AnnonceController::class, 'browse'])->name('browse');
        // page add
        Route::get('/add', [AnnonceController::class, 'add'])->name('add');
        Route::post('/add', [AnnonceController::class, 'store'])->name('store');
        // page edit
        Route::get('/edit/{id}', [AnnonceController::class, 'edit'])->name('edit');
        Route::patch('/edit/{id}', [AnnonceController::class, 'update'])->name('update');
        // page delete
        Route::delete('/delete/{id}', [AnnonceController::class, 'delete'])->name('delete');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
