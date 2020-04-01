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

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth','super-admin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::namespace('Super')->group(function () {
        Route::prefix('company')->group(function () {
            Route::get('/', 'CompanyController@index')->name('company');
            Route::get('/add', 'CompanyController@addcompany')->name('add-company');
        });
    });
    // Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
});

Route::group(['middleware' => ['auth','user']], function () {
    Route::get('/user', 'UserController@index')->name('user');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');