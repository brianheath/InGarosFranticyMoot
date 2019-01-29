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
    Route::put('/admin/user/{id}', 'AdminController@updateUser');

    Route::post('/admin/edit_css', 'AdminController@updateCSS');
    
    Route::get('/admin/edit_page/{id}', 'AdminController@editPage');
    Route::get('/admin/edit_post/{id}', 'AdminController@editPost');
    Route::get('/admin/edit_user/{id}', 'AdminController@editUser');
    
    Route::controller('/admin', 'AdminController');
});

Route::get('/', 'HomeController@index');

Route::get('/{page_name}', 'HomeController@page');

//Route::resource('/admin', 'AdminController');