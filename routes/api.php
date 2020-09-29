<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('v1/stk_push', 'MpesaController@stk_push');

Route::post('v1/access/token', 'MpesaController@generateAccessToken');
Route::post('v1/laratest/stk/push', 'MpesaController@customerMpesaSTKPush');
Route::post('v1/laratest/validation', 'MpesaController@mpesaValidation');
Route::post('v1/laratest/transaction/confirmation', 'MpesaController@mpesaConfirmation');
Route::post('v1/laratest/register/url', 'MpesaController@mpesaRegisterUrls');
