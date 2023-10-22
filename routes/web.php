<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Products\CreateController;
use App\Http\Controllers\Products\StoreController;
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

Route::get('/', [ProductController::class,"index"])->name("products.index");
Route::get('/products', [ProductController::class,"filter"])->name("products.filter");
Route::get('/products/create', [CreateController::class,"create"])->name("products.create");
Route::post('/products/create', [StoreController::class,"store"])->name("products.store");
