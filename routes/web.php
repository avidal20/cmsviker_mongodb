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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

//Rutas de administracion
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'HomeController@index')->name('admin');

    //Rutas de modulos
    Route::resource('categories', 'Category\CategoryController');

    // Features - Caracteristicas
    Route::get('features', 'Features\FeatureController@index')->name('features');
    Route::get('features/sizes', 'Features\FeatureController@sizes')->name('features.sizes');
    Route::get('features/colors', 'Features\FeatureController@colors')->name('features.colors');

});
