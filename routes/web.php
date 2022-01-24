<?php

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
Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
});

Route::get('/logout/', "App\Http\Controllers\Auth\LoginController@logout")->name('logout');
Route::get('/', "App\Http\Controllers\MainController@index")->name('index');
Route::get("/categories/", "App\Http\Controllers\MainController@categories")->name('categories');
Route::get('/basket/', 'App\Http\Controllers\BasketController@basket')->name('basket');
Route::get('/basket/place/', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
Route::post('basket/add/{id}/', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
Route::post('basket/remove/{id}/', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
Route::post('/basket/confirm/', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
Route::get('/categories/{category}/',"App\Http\Controllers\MainController@category")->name('category');
Route::get('/categories/{category}/{product_code}/', "App\Http\Controllers\MainController@product")->name('product');
Route::get('/catalog/', "App\Http\Controllers\CatalogController@index")->name('catalog');
Route::match(['GET', 'POST'],'/json-catalog/', "App\Http\Controllers\CatalogController@json");
