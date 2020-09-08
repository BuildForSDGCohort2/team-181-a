<?php

Route::group(['namespace' => 'Supplier'], function() {
    Route::get('/', 'HomeController@index')->name('supplier.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('supplier.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('supplier.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('supplier.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('supplier.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('supplier.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('supplier.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('supplier.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('supplier.verification.notice');
    Route::get('email/verify/{id}/{hash}','Auth\VerificationController@verify')->name('supplier.verification.verify');
});