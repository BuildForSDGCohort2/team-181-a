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


Auth::routes(['verify' => true]);
// Auth::routes();


Route::get('/', function () {
    return view('welcome');
});


Route::get('/supplier-browse', 'HomeController@supplier_browse')->name('supplier_browse');
Route::get('/professional-browse', 'HomeController@professional_browse')->name('professional_browse');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');


    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');


    Route::get('deletedUsers', 'UserController@deletedUsers')->name('deletedUsers');

});
