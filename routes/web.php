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

Route::get('/test', function () {
    $size = new Features_sizes_category();
    $size->name = '111';
    $size->state = '111';
    $size->save();

    $color = new Features_color();
    $color->name = '111';
    $color->state = '111';
    $color->image = '111';
    $color->save();

});

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

    Route::get('features/sizes', 'Features\FeatureSizesCategoryController@index')->name('features.sizes');
    Route::get('features/sizes/create', 'Features\FeatureSizesCategoryController@create')->name('features.sizes.create');
    Route::post('features/sizes/store', 'Features\FeatureSizesCategoryController@store')->name('features.sizes.store');
    Route::post('features/sizes/edit', 'Features\FeatureSizesCategoryController@edit')->name('features.sizes.edit');
    Route::post('features/sizes/delete', 'Features\FeatureSizesCategoryController@delete')->name('features.sizes.delete');

    Route::get('features/colors', 'Features\FeatureController@colors')->name('features.colors');

    // Product
    Route::get('products/home', 'Products\ProductController@home')->name('products.home');
    Route::get('products/ajax/category/{id?}', 'Products\ProductController@ajaxCategory')->name('products.ajax.category');
    Route::PUT('products/ajax/InputsTypeSize/{id?}', 'Products\ProductController@AjaxInputsTypeSize')->name('products.ajax.InputsTypeSize');
    Route::resource('products', 'Products\ProductController');


});
