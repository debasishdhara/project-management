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

Route::group(['middleware' => ['auth']], function () {
    Route::namespace('Super')->group(function () {
        Route::prefix('common')->group(function () {
            Route::post('/get-country', 'CommonpanelController@get_country')->name('countries');
            Route::post('/get-state', 'CommonpanelController@get_state')->name('states');
            Route::post('/get-city', 'CommonpanelController@get_city')->name('cities');
            Route::post('/get-sub-city', 'CommonpanelController@get_sub_city')->name('sub-cities');
        });
    });
});

Route::group(['middleware' => ['auth','super-admin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::namespace('Super')->group(function () {
        Route::prefix('company')->group(function () {
            Route::get('/', 'CompanyController@index')->name('company');
            Route::post('/company-json', 'CompanyController@get_company_json')->name('company-jsons');
            Route::get('/add', 'CompanyController@addcompany')->name('add-company');
        });
        Route::prefix('users')->group(function () {
            Route::get('/', 'UsersmaintainController@index')->name('users');
            Route::post('/user-json', 'UsersmaintainController@get_users_json')->name('user-jsons');
            Route::get('/add', 'UsersmaintainController@addUsers')->name('add-users');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/fetch-role', 'RoleController@index')->name('fetch-role');
            Route::post('/fetch-role', 'RoleController@get_role_json')->name('fetch-role');
            Route::get('/fetch-permission', 'PermissionController@index')->name('fetch-permission');
            Route::post('/fetch-permission', 'PermissionController@get_permission_json')->name('fetch-permission');
            Route::get('/fetch-licence', 'LicenceController@index')->name('fetch-licence');
        });
        Route::prefix('common')->group(function () {
            Route::get('/fetch-country', 'LocationController@show_country')->name('fetch-countries');
            Route::post('/add-country', 'LocationController@show_country')->name('add-countries');
            Route::post('/delete-country/{country_id}', 'LocationController@show_country')->name('delete-countries');
            Route::post('/edit-country/{country_id}', 'LocationController@show_country')->name('edit-countries');

            Route::get('/fetch-state', 'LocationController@show_state')->name('fetch-states');
            Route::post('/add-state', 'LocationController@show_state')->name('add-states');
            Route::post('/delete-state/{state_id}', 'LocationController@show_state')->name('delete-states');
            Route::post('/edit-state/{state_id}', 'LocationController@show_state')->name('edit-states');

            Route::get('/fetch-city', 'LocationController@show_city')->name('fetch-cities');
            Route::get('/add-city', 'LocationController@add_city')->name('add-cities');
            Route::post('/add-city', 'LocationController@add_city')->name('add-cities');
            Route::delete('/delete-city/{city_id}', 'LocationController@delete_city')->name('delete-cities');
            Route::post('/edit-city/{city_id}', 'LocationController@show_city')->name('edit-cities');

            Route::get('/fetch-sub-city', 'LocationController@show_sub_city')->name('fetch-sub-cities');
            Route::post('/add-sub-city', 'LocationController@show_sub_city')->name('add-sub-cities');
            Route::post('/delete-sub-city/{sub_city_id}', 'LocationController@show_sub_city')->name('delete-sub-cities');
            Route::post('/edit-sub-city/{sub_city_id}', 'LocationController@show_sub_city')->name('edit-sub-cities');

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