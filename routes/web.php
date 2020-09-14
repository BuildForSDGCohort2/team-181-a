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
	// this will show all of the animals registered
	Route::get('animal-list', function () {
		return view('animals.index');
	})->name('animals_table');

	Route::get('animal-list', function () {
		return view('animals.index');
})->name('animals_table');

	// this will contain have the breed id etc
	Route::get('breed-info', function () {
		return view('animals.breed');
	})->name('breed_info');

	Route::get('animalShow',function(){
		return view('animals.show');
	})->name('animal_show');

	// this will display all of the plants planted in the farm

	Route::get('plant-table', function () {
		return view('plants.index');
	})->name('plants_table');

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

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

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
});

Route::resource('/animal', 'AnimalsController', ['except' => ['create','index']]);
Route::resource('/plant', 'PlantsController', ['except' => ['create','index']]);
Route::resource('/brood', 'BroodsController', ['except' => ['create','index']]);