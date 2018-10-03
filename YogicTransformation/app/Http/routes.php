<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('home');
//});

Route::auth();

Route::group(['middleware' => 'role:admin'], function() {
    Route::delete('/admin/{type}/{id}', 'AdminController@destroy');
    Route::put('/admin/page/{id}', 'AdminController@updatePage');
    Route::get('/admin/edit_page/{id}', 'AdminController@editPage');
    Route::controller('/admin', 'AdminController');
});

Route::get('/', 'HomeController@index');

Route::get('/{page_name}', 'HomeController@page');

//Route::resource('/admin', 'AdminController');