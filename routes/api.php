<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/****[Module Products]****/

  //categorys
  Route::GET('products/category/', 'Products\Api\ProductCategoryController@index')->name('api.products.category.index');
  Route::POST('products/category/','Products\Api\ProductCategoryController@store')->name('api.products.category.store');
  Route::GET('products/category/{id}', 'Products\Api\ProductCategoryController@show')->name('api.products.category.show');
  Route::DELETE('products/category/{id}','Products\Api\ProductCategoryController@destroy')->name('api.products.category.destroy');
  Route::PUT('products/category/{id}','Products\Api\ProductCategoryController@update')->name('api.products.category.update');

	//Product
	Route::GET('products/{idCategory}', 'Products\Api\ProductController@index')->name('api.products.index');
	Route::GET('products/product/{id}', 'Products\Api\ProductController@show')->name('api.products.show');
	Route::POST('products/','Products\Api\ProductController@store')->name('api.products.store');
  Route::PUT('products/product/{id}','Products\Api\ProductController@update')->name('api.products.update');
	Route::DELETE('products/product/{id}','Products\Api\ProductController@destroy')->name('api.products.destroy');
