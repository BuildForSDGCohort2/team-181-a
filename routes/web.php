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
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('stores','StorageController@all_items')->name('storage');
	Route::post('plantation/{id}/schedule_harvest','StorageController@schedule_harvest')->name('scheduleharvest');
	Route::post('plantation/{id}/harvest','StorageController@harvest')->name('harvest');
	Route::get('orders','OrdersController@my_orders')->name('orders');
	Route::resource('plant', 'PlantsController', ['except' => ['create']]);

	Route::post('deduct/{id}/brood','BroodsController@deduct')->name('deduct_brood_number');
	Route::post('sell/{id}/brood','BroodsController@sell_bird')->name('sell_poultry');
	Route::resource('brood', 'BroodsController', ['except' => ['create']]);

	Route::post('death/{id}/animal','AnimalsController@death')->name('death_of_animal');
	Route::post('sell/{id}/animal','AnimalsController@sell_animal')->name('sell_animal');
	Route::resource('animal', 'AnimalsController', ['except' => ['create']]);

	Route::get('notifications','NotificationsController@notification_selector')->name('notifications');
	Route::get('pending_suppliers','NotificationsController@get_suppliers')->name('pending_suppliers');
	Route::get('issues','NotificationsController@get_issues')->name('issues');
	Route::post('sell/{id}/product','StorageController@sell_from_storage')->name('sell_from_storage');
	Route::post('take/{id}/product','StorageController@take_from_storage')->name('take_from_storage');

	Route::post('order/{id}/product','OrdersController@place_order')->name('place_order');
	Route::get('order/dispatch','OrdersController@dispatch_orders')->name('dispatch');
	Route::get('order/{orders}/dispatch','OrdersController@order_pick_up')->name('transit');


	Route::get('get_animal','AnimalsController@get_animal')->name('get_animal');

	Route::get('get_notifications','NotificationsController@get_notifications')->name('get_notifications');

});



// enrolement
Route::post('profesionals_enrole','EnrolmentController@profesionals_enrole')->name('profesionals_enrole');
Route::post('suppliers_enrole','EnrolmentController@suppliers_enrole')->name('suppliers_enrole');
Route::post('farmers_enrole','EnrolmentController@farmers_enrole')->name('farmers_enrole');
Route::post('customer_enrole','EnrolmentController@customer_enrole')->name('customer_enrole');

Route::get('on_sale','OrdersController@for_sale')->name('on_sale');
Route::get('on_sale/{id}/view','OrdersController@view_prod')->name('viewprod');


Route::get('search_brood/{search}','BroodsController@search_brood')->name('search_brood');

Route::get('professionals','BrowseController@professionals')->name('professionals');
Route::get('suppliers','BrowseController@suppliers')->name('suppliers');


Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('login/instagram', 'Auth\LoginController@redirectToInstagramProvider')->name('instagram.login');

Route::get('login/instagram/callback', 'Auth\LoginController@instagramProviderCallback')->name('instagram.login.callback');
Route::get('show_issue/{id}','NotificationsController@show_issue')->name('show_issue');
