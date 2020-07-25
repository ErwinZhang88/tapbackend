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

Route::get('/menu', 'API\MenuController@index')->name('menu');
Route::post('/content', 'API\MenuController@content')->name('content');
Route::post('/keluhankami', 'API\ComplainController@index')->name('keluhankami');
Route::post('/uploadbukti', 'API\ComplainController@upload')->name('uploadbukti');
Route::post('/content/detail', 'API\MenuController@detail')->name('content.detail');
