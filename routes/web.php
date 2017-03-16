<?php

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

Route::group(['middleware' => 'LenguageSwicher'], function () {
  Auth::routes();
  Route::GET('/{idCategory?}', 'UserController@index')->name('home_user');
  Route::GET('/language_user/{locale}', 'LanguageController@index')->name('language_user');
});


Route::group(['middleware' => ['LenguageSwicher', 'auth'], 'prefix' => 'admin'], function () {

	//Idioma
    Route::GET('/language/{locale}', 'LanguageController@index')->name('language');

    //Categories
    Route::GET('/home', 'Products\CategoryController@index')->name('home');
    Route::GET('/products/category/create', 'Products\CategoryController@create')->name('category.create');
    Route::POST('/products/category/', 'Products\CategoryController@store')->name('category.store');
    Route::GET('/products/category/{id}/edit', 'Products\CategoryController@edit')->name('category.edit');
    Route::PATCH('/products/category/{id}', 'Products\CategoryController@update')->name('category.update');
    Route::GET('/products/category/{id}', 'Products\CategoryController@show')->name('category.show');
    Route::DELETE('/products/categorys/{id}', 'Products\CategoryController@destroy')->name('category.destroy');

    //Products
    Route::GET('/products/{idCategory}', 'Products\ProductsController@index')->name('products.index');
    Route::GET('/products/{idCategory}/create', 'Products\ProductsController@create')->name('products.create');
    Route::POST('/products/{idCategory}/', 'Products\ProductsController@store')->name('products.store');
    Route::GET('/products/{idCategory}/{id}/edit', 'Products\ProductsController@edit')->name('products.edit');
    Route::PATCH('/products/{idCategory}/{id}', 'Products\ProductsController@update')->name('products.update');
    Route::GET('/products/{idCategory}/{id}', 'Products\ProductsController@show')->name('products.show');
    Route::DELETE('/products/{idCategory}/{id}', 'Products\ProductsController@destroy')->name('products.destroy');
});
