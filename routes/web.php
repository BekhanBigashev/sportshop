<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/', "App\Http\Controllers\MainController@index")->name('index');

Route::get('/logout/', "App\Http\Controllers\Auth\LoginController@logout")->name('logout');

Route::get("/catalog/", "App\Http\Controllers\CatalogController@categories")->name('categories');

Route::get('/basket/', 'App\Http\Controllers\BasketController@basket')->name('basket');
Route::get('/basket/place/', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
Route::post('/basket/add/{id}/', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
Route::post('/basket/ajax/add/{id}/', 'App\Http\Controllers\AjaxController@basketAdd')->name('basket.ajax.add');
Route::post('/basket/remove/{id}/', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
Route::post('/basket/confirm/', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
Route::post('/basket/ajax/count/', 'App\Http\Controllers\AjaxController@getBasketCount')->name('basketCount');

Route::post('/order/ajax/delete/{orderId}',"App\Http\Controllers\AjaxController@deleteOrder");

Route::get('/catalog/{category}/',"App\Http\Controllers\CatalogController@catalog")->name('catalog');
Route::get('/catalog/{category}/{product_id}/', "App\Http\Controllers\CatalogController@product")->name('product');

Route::post('/review/add/{product_id}', 'App\Http\Controllers\ReviewController@add')->name('review.add');

Route::get('/search/', "App\Http\Controllers\MainController@search")->name('search');

Route::post('/user/ajax/update/{user_id}', 'App\Http\Controllers\AjaxController@updateUser');

Route::get('/test/', "App\Http\Controllers\MainController@test")->name('test');

//Route::get('fill_db_data/{category}', "App\Http\Controllers\MainController@fill_db_data")->name('fill_db_data');


Route::get('/artisan-migrate', \App\Http\Controllers\ArtisanController::class);

