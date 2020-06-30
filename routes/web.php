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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/homes', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@input')->name('home');
Route::get('/menu', 'HomeController@menu')->name('menu');
Route::get('/menucreate', 'HomeController@menucreate')->name('menucreate');
Route::get('/pages', 'HomeController@pages')->name('pages');
Route::get('/category', 'HomeController@category')->name('category');
Route::get('/categorycreate', 'HomeController@categorycreate')->name('categorycreate');
Route::get('/post', 'HomeController@post')->name('post');
Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });