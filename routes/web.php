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

Route::get('/', 'MenuController@index')->name('home');
Route::get('/homes', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@input')->name('home');
Route::get('/pages', 'HomeController@pages')->name('pages');
Route::get('/post', 'HomeController@post')->name('post');

Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::resource('menu', 'MenuController', ['as' => 'admin']);
    Route::resource('category', 'CategoryController', ['as' => 'admin']);
    Route::resource('banner', 'BannerController', ['as' => 'admin']);
    Route::resource('filelist', 'FileListController', ['as' => 'admin']);
    Route::resource('complaint', 'ComplaintController', ['as' => 'admin']);
    Route::resource('setting', 'SettingController', ['as' => 'admin']);
    Route::resource('sosmed', 'SosmedController', ['as' => 'admin']);
    Route::resource('settingform', 'SettingFormController', ['as' => 'admin']);
    //export excel complain
    Route::get('/complaint/export/data', 'ComplaintController@export')->name('admin.complaint.export');
    //end
    //add Content
    Route::get('/content/{eventid}', 'ContentController@index')->name('admin.content');
    Route::get('/content/create/{eventid}', 'ContentController@create')->name('admin.content.create');
    Route::get('/content/edit/{eventid}/{id}', 'ContentController@edit')->name('admin.content.edit');
    Route::put('/content/update/{eventid}/{id}', 'ContentController@update')->name('admin.content.update');
    Route::post('/content/store/{eventid}', 'ContentController@store')->name('admin.content.store');
    Route::delete('/content/destroy/{id}', 'ContentController@destroy')->name('admin.content.destroy');
    Route::post('/content/upload', 'ContentController@upload')->name('admin.content.upload');
    //end content
    //edit konten home
    Route::get('/home/edit/{id}', 'ContentController@edithome')->name('admin.home.edit');
    Route::put('/home/update/{eventid}/{id}', 'ContentController@updatehome')->name('admin.home.update');
    //end

});
Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });