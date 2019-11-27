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

Route::group(['prefix' => 'Dashboard'], function(){
	// Dashboard
	Route::get('', 'DashboardController@index')->name('dashboard.index');
	// Admin
	Route::get('admin', 'UserRoleController@index')->name('admin.index');
	Route::post('admin', 'UserRoleController@store')->name('admin.store');
	Route::put('admin/{user_id}/{role_id}', 'UserRoleController@update')->name('admin.update');
	// Admin Roles
	Route::get('roles', 'RoleController@index')->name('role.index');
	Route::post('roles', 'RoleController@store')->name('role.store');
	Route::delete('roles/{role}', 'RoleController@destroy')->name('role.destroy');
	// Media
	// Route::get('media', 'MediaController@index')->name('media.index');
	// Route::get('media/create', 'MediaController@create')->name('media.create');
	// Route::post('media', 'MediaController@store')->name('media.store');
	// Route::delete('media/{category_id}/{media_id}', 'CategoryMediaController@destroy')->name('media.destroy');
	// Category
	Route::get('category', 'CategoryController@index')->name('category.index');
	Route::post('category', 'CategoryController@store')->name('category.store');
	Route::put('category/{category}', 'CategoryController@update')->name('category.update');
	Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');
});
// Media
Route::get('media', 'MediaController@index')->name('media.index');
Route::get('media/create', 'MediaController@create')->name('media.create');
Route::post('media', 'MediaController@store')->name('media.store');
Route::delete('media/{category_id}/{media_id}', 'CategoryMediaController@destroy')->name('media.destroy');