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
use App\Features_sizes_category;
use App\Features_color;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

//Rutas de administracion
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'HomeController@index')->name('admin');

    //Rutas de modulos

    // Categories - Categorias
    Route::resource('categories', 'Category\CategoryController');

    // Features - Caracteristicas
    Route::get('features', 'Features\FeatureController@index')->name('features');
    Route::resource('sizes', 'Features\FeatureSizesCategoryController');
    Route::resource('colors', 'Features\FeatureColorsController');
    Route::get('features/colors', 'Features\FeatureController@colors')->name('features.colors');

    // Product
    Route::get('products/home', 'Products\ProductController@home')->name('products.home');
    Route::get('products/ajax/category/{id?}', 'Products\ProductController@ajaxCategory')->name('products.ajax.category');
    Route::PUT('products/ajax/InputsTypeSize/{id?}', 'Products\ProductController@AjaxInputsTypeSize')->name('products.ajax.InputsTypeSize');
    Route::resource('products', 'Products\ProductController');

    //Kids
    Route::get('kids/ajax/category/{id?}', 'Products\KidsController@ajaxCategory')->name('kids.ajax.category');
    Route::get('kids/ajax/product/{id?}', 'Products\KidsController@ajaxProduct')->name('kids.ajax.product');
    Route::get('kids/ajax/product/{idKid}/{id?}', 'Products\KidsController@ajaxProductEdit')->name('kids.ajax.product.edit');
    Route::put('kids/ajax/productselected', 'Products\KidsController@ajaxProductSelect')->name('kids.ajax.product.select');
    Route::resource('kids', 'Products\KidsController');

    // Grupos
    Route::resource('groups', 'Groups\GroupController');
    
});