<?php

use App\Http\Controllers\Products\ProductCreateController;
use App\Http\Controllers\Products\ProductGetController;
use App\Http\Controllers\Products\ProductStoreController;
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

Route::get('/', [ProductGetController::class,"index"])->name("products.index");
Route::get('/products', [ProductGetController::class,"filter"])->name("products.filter");
Route::get('/products/create', [ProductCreateController::class,"create"])->name("products.create");
Route::post('/products/create', [ProductStoreController::class,"store"])->name("products.store");
