<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('login');
});

Route::post('/auth', [LoginController::class, 'authenticate']);

Route::get('/user', [UserController::class, 'get'])
    ->middleware('auth');

Route::get('/user/products', [UserController::class, 'purchased'])
    ->middleware('auth');

Route::get('/products', [ProductController::class, 'get']);

Route::put('/products/{sku}/{name}', [ProductController::class, 'add'])
    ->middleware('auth');

Route::delete('/products/{sku}', [ProductController::class, 'delete'])
    ->middleware('auth');
?>