<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('item', 'App\Http\Controllers\ItemController');
Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::resource('order', 'App\Http\Controllers\OrderController');
Route::resource('order.bill', 'App\Http\Controllers\OrderController')->shallow();
Route::resource('manage', 'App\Http\Controllers\ManageController');
Route::resource('sales', 'App\Http\Controllers\SalesController');

Route::get('order/{user}/create', [OrderController::class, 'create']);