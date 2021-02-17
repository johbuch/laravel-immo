<?php

use App\Http\Controllers\Api\AnnonceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('annonces', [AnnonceController::class, 'browse'])->name('api_annonces_browse');
Route::get('annonces/{id}', [AnnonceController::class, 'show'])->name('api_annonces_show');
Route::post('annonces/add', [AnnonceController::class, 'store'])->name('api_annonces_add');
Route::put('annonces/edit/{id}', [AnnonceController::class, 'update'])->name('api_annonces_update');
Route::delete('annonces/delete/{id}', [AnnonceController::class, 'delete'])->name('api_annonces_delete');
