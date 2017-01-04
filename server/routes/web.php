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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', 'PageController@index');
Route::get('/broadcast', 'PageController@broadcast');

Route::get('/nodes/{node}/online', 'NodeController@online');
Route::get('/nodes/{node}/status', 'NodeController@status');
Route::resource('nodes', 'NodeController');

Route::post('/start/{alert}', 'PlaybackController@start');
Route::post('/stop', 'PlaybackController@stop');
Route::resource('alerts', 'AlertController');