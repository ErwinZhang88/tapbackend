<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/homes', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@input')->name('home');
Route::get('/pages', 'HomeController@pages')->name('pages');
Route::get('/post', 'HomeController@post')->name('post');

Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::resource('menu', 'MenuController', ['as' => 'admin']);
    Route::resource('category', 'CategoryController', ['as' => 'admin']);
    Route::resource('banner', 'BannerController', ['as' => 'admin']);
    //add Content
    Route::get('/content/{eventid}', 'ContentController@index')->name('admin.content');
    Route::get('/content/create/{eventid}', 'ContentController@create')->name('admin.content.create');
    Route::get('/content/edit/{id}', 'ContentController@edit')->name('admin.content.edit');
    Route::put('/content/update/{id}', 'ContentController@update')->name('admin.content.update');
    Route::post('/content/save/{eventid}', 'ContentController@store')->name('admin.content.save');
    Route::delete('/content/{id}', 'ContentController@delete')->name('contentDelete');
    //end content

});
Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });