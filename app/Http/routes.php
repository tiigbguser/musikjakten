<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/settings', 'ProfileController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('/logs', 'LogController@index');


    Route::post('json/genome/save', 'GenomeController@store');

    Route::get('json/logs', 'LogController@getJson');
    Route::post('json/logs/save', 'LogController@store');

    Route::get('json/settings', 'ProfileController@getJson');
    Route::post('json/settings/save', 'ProfileController@store');

    // Route::get('json/logs', function(){
    // 	App\Log::all();
    // });

});

?>