<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'admin',
        'as' => 'admin.',
    ],
    function () {
        Route::group(
            [
                'prefix' => 'clients',
                'as' => 'clients.',
            ],
            function () {
                Route::get('/', [ClientController::class, 'index'])->name('index');
            }
        );

        Route::group(
            [
                'prefix' => 'products',
                'as' => 'products.',
            ],
            function () {
                Route::get('/{client_id}/client', [ProductController::class, 'index'])->name('index');
                Route::get('/ajax', [ProductController::class, 'ajax'])->name('ajax');
                Route::post('/store', [ProductPriceController::class, 'storeProductPrice'])->name('store.price');
            }
        );
    }
);


Route::get('/products/list', [ProductController::class, 'list'])->name('products.list')->middleware('auth');
