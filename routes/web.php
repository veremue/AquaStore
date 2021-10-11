<?php

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

/*Route::get('/', function () {
    return view('home');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//customer claims
Route::prefix('aquaria')->group(function (){
    Route::post('storeaquaria', [App\Http\Controllers\UpdateController::class, 'storeaquaria'])->middleware('auth');
    Route::post('storefish', [App\Http\Controllers\UpdateController::class, 'storefish'])->middleware('auth');
    Route::get('show/{id}',[App\Http\Controllers\ViewController::class, 'show'])->middleware('auth');
    Route::get('removefish/{id}',[App\Http\Controllers\UpdateController::class, 'removefish'])->middleware('auth');
    Route::post('updatefish', [App\Http\Controllers\UpdateController::class, 'updatefish'])->middleware('auth');
});
