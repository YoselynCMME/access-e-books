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
// Auth::routes();

Auth::routes(['register' => false]);

Route::name('books.')->prefix('books')->middleware('auth')->group(function () {
    // Route::post('save_book', 'BookController@save_book')->name('save_book');
    Route::get('get_book/{slug}', 'BookController@show')->name('get_book');
    Route::get('material/{slug}', 'BookController@material')->name('material');

    Route::put('update_book', 'BookController@update')->name('update_book');
    Route::post('save_book', 'BookController@store')->name('save_book');
    Route::get('delete_book', 'BookController@delete')->name('delete_book');
});

Route::name('materials.')->prefix('materials')->middleware('auth')->group(function () {
    Route::get('home', 'HomeController@home_materials')->name('home');
    Route::get('extra/{id}', 'BookController@get_extra')->name('extra');
});

Route::name('administrator.')->prefix('administrator')->middleware('auth')->group(function () {
    Route::get('home', 'AdminController@index')->name('home');
    Route::get('users', 'AdminController@users')->name('users');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::name('users.')->prefix('users')->middleware('auth')->group(function () {
    Route::put('update_user', 'UserController@update')->name('update_user');
    Route::get('delete_user', 'UserController@delete')->name('delete_user');
    Route::get('show_books', 'UserController@books')->name('show_books');
    Route::get('delete_book', 'UserController@delete_book')->name('delete_book');
    Route::post('save_book', 'UserController@save_book')->name('save_book');
});
