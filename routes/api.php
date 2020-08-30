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

Route::get('/home', 'API\HomeController@index')->name('home');
Route::get('/readmore', 'API\HomeController@readmore')->name('readmore');
Route::get('/footer', 'API\HomeController@footer')->name('footer');
Route::get('/karir', 'API\HomeController@karir')->name('karir');
Route::get('/menu', 'API\MenuController@index')->name('menu');
Route::post('/content', 'API\MenuController@content')->name('content');
Route::get('/formkeluhan', 'API\ComplainController@formkeluhan')->name('formkeluhan');
Route::get('/tabelkeluhan', 'API\ComplainController@tabelkeluhan')->name('tabelkeluhan');
Route::get('/keluhan', 'API\ComplainController@listkeluhan')->name('keluhan');
Route::post('/keluhankami', 'API\ComplainController@index')->name('keluhankami');
Route::post('/uploadbukti', 'API\ComplainController@upload')->name('uploadbukti');
Route::post('/content/detail', 'API\MenuController@detail')->name('content.detail');
