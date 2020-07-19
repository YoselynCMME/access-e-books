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

Route::name('books.')->prefix('books')->middleware(['auth'])->group(function () {
    Route::post('save_book', 'BookController@save_book')->name('save_book');
    Route::get('get_book/{slug}', 'BookController@show')->name('get_book');
});

Route::name('materials.')->prefix('materials')->middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@home_materials')->name('home');
    Route::get('extra/{id}', 'BookController@get_extra')->name('extra');
});

Auth::routes();
