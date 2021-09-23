<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get-movie', [HomeController::class, 'getMovie']);
Route::get('/set-favourite', [HomeController::class, 'setFavourite']);
Route::post('/contact-us', [HomeController::class, 'contactUs']);

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
