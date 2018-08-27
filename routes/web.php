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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/idea', 'TerritoriesController@index');

Route::post('/new-user', 'CitizensController@create');

Route::get('/terrs', 'TerritoriesController@index');

Route::get(
    '/ajax/select/{type}/{region_id}/{ter_pid?}',
    'TerritoriesController@nextSelect'
);

Route::get('/ajax/user/{email}', 'CitizensController@checkEmail');