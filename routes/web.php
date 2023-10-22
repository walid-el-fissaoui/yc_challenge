<?php

use App\Http\Controllers\Products\ProductCreateController;
use App\Http\Controllers\Products\ProductFilterController;
use App\Http\Controllers\Products\ProductGetJsonController;
use App\Http\Controllers\Products\ProductIndexController;
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

Route::get('/', [ProductIndexController::class,"index"])->name("products.index");
Route::get('/products', [ProductGetJsonController::class,"getJSON"])->name("products.list");
Route::get('/products/filter', [ProductFilterController::class,"filter"])->name("products.filter");
Route::get('/products/create', [ProductCreateController::class,"create"])->name("products.create");
Route::post('/products/create', [ProductStoreController::class,"store"])->name("products.store");
