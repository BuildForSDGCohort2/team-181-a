<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	// this will contain have the breed id etc
	Route::get('breed-info', function () {
		return view('animals.breed');
	})->name('breed_info');

	Route::get('animalShow',function(){
		return view('animals.show');
	})->name('animal_show');

	// this will display all of the plants planted in the farm

	// Route::get('plant-table', function () {
	// 	return view('plants.index');
	// })->name('plants_table');

	Route::get('plant-info', function () {
		return view('plants.info');
	})->name('plant_info');
	
	Route::get('plantShow',function(){
		return view('plants.show');
	})->name('plant_show');


// Brood
	Route::get('brood-list', function () {
		return view('broods.index');
	})->name('broods_table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');


	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');



});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('stores','StorageController@all_items')->name('storage');
	Route::post('plantation/{id}/schedule_harvest','StorageController@schedule_harvest')->name('scheduleharvest');
	Route::post('plantation/{id}/harvest','StorageController@harvest')->name('harvest');
	Route::get('orders','OrdersController@my_orders')->name('orders');
	Route::resource('animal', 'AnimalsController', ['except' => ['create']]);
	Route::resource('plant', 'PlantsController', ['except' => ['create']]);
	Route::resource('brood', 'BroodsController', ['except' => ['create']]);
	Route::get('notifications','NotificationsController@notification_selector')->name('notifications');
	Route::get('pending_suppliers','NotificationsController@get_suppliers')->name('pending_suppliers');
	Route::get('issues','NotificationsController@get_issues')->name('issues');

});



// enrolement
Route::post('profesionals_enrole','EnrolmentController@profesionals_enrole')->name('profesionals_enrole');
Route::post('suppliers_enrole','EnrolmentController@suppliers_enrole')->name('suppliers_enrole');
Route::post('farmers_enrole','EnrolmentController@farmers_enrole')->name('farmers_enrole');

Route::get('on_sale','OrdersController@for_sale')->name('on_sale');
Route::get('on_sale/{id}/view','OrdersController@view_prod')->name('viewprod');

