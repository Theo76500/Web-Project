<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', 'UsersController@index');

Route::get('/{id}/profile', 'UsersController@show');

Route::get('login', 'UsersController@login');

Route::post('login', 'UsersController@logSecure');

Route::get('registration', 'UsersController@registration');

Route::post('registration', 'UsersController@regSecure');

Route::post('/activity/{id}/pictures-act-post', 'UsersController@picActPost');

Route::get('shop', 'UsersController@shop');

Route::get('/{id}/mon-panier', 'UsersController@panier');

Route::get('legal-mentions', 'UsersController@legalMentions');

Route::get('CGU', 'UsersController@cgu');

Route::get('CGV', 'UsersController@cgv');

Route::get('activity/{id}', 'UsersController@showAct');

Route::get('logout', 'UsersController@logout');

Route::post('result', 'UsersController@result');

Route::get('register-activity/{id}', 'UsersController@regAct');

Route::get('addCommand/{product}','UsersController@addCommand');



Route::get('admin', 'AdminsController@index');

Route::get('admin/see', 'AdminsController@see');

Route::get('admin/insert', 'AdminsController@insert');

Route::post('admin/pictures-admin-post', 'AdminsController@pictures');



Route::get('staff','StaffCesi@index');

Route::post('staff/download-pictures','StaffCesi@download');