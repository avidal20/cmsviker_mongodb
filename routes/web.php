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
Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin'], function () {

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
    Route::get('kids/ajax/product/{id?}', 'Products\KidsController@ajaxProduct')->name('kids.ajax.product');
    Route::get('kids/ajax/product/{idKid}/{id?}', 'Products\KidsController@ajaxProductEdit')->name('kids.ajax.product.edit');
    Route::put('kids/ajax/productselected', 'Products\KidsController@ajaxProductSelect')->name('kids.ajax.product.select');
    Route::resource('kids', 'Products\KidsController');

    // Grupos
    Route::resource('groups', 'Groups\GroupController');
    Route::get('groups/{id}/users', 'Groups\GroupController@users')->name("groups.users");
    Route::get('groups/{id}/users/create', 'Groups\GroupController@createUser')->name("groups.createUser");
    Route::get('groups/users/{id}/edit', 'Groups\GroupController@editUser')->name("groups.editUser");
    Route::post('groups/users/store', 'Groups\GroupController@storeUser')->name("groups.storeUser");
    Route::put('groups/users/{id}', 'Groups\GroupController@updateUser')->name("groups.updateUser");
    Route::get('groups/users/{id}', 'Groups\GroupController@showUser')->name("groups.showUser");
    Route::delete('groups/users/{id}', 'Groups\GroupController@destroyUser')->name("groups.destroyUser");
    Route::get('groups/{id}/users/import', 'Groups\GroupController@importUsers')->name("groups.importUsers");
    Route::post('groups/{id}/users/import', 'Groups\GroupController@importUsersProcess')->name("groups.importUsersProcess");
    Route::put('groups/users/ajax/changeadmin', 'Groups\GroupController@ajaxChangeAdmin')->name("groups.ajax.changeadmin");

    //Usuarios
    Route::PUT('users/permissions/{id}', 'Users\UsersController@permissionsUpdate')->name('users.permissions.update');
    Route::get('users/permissions/{id}/edit', 'Users\UsersController@permissions')->name('users.permissions');
    Route::resource('users', 'Users\UsersController');
    
});

Route::group(['middleware' => 'auth'], function () {

    // Categories - Categorias
    Route::resource('coupons', 'Coupons\CouponsController');

});

