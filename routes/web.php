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
/** */
Route::get('/', function () {
    return view('welcome');
});

/** */
Auth::routes(['register' => false]);

/** Authenticate Required Route */
Route::group(['middleware' => ['auth']], function () {
    /** Super Folder Access */
    Route::namespace('Super')->group(function () {
        /** Common Route */
        Route::prefix('common')->group(function () {
            Route::post('/state-json', 'CommonpanelController@state_json')->name('state-json');
            Route::post('/city-json', 'CommonpanelController@city_json')->name('city-json');
        });
    });
});
/** Super Admin*/
Route::group(['middleware' => ['auth','super-admin']], function () {
    /** Dashboard */
    Route::get('/home', 'HomeController@index')->name('home');
    /** Super Folder Access */
    Route::namespace('Super')->group(function () {
        /** Company */
        Route::prefix('company')->group(function () {
            Route::get('/', 'CompanyController@index')->name('company');
            Route::post('/company-json', 'CompanyController@get_company_json')->name('company-jsons');
            Route::get('/add', 'CompanyController@addcompany')->name('add-company');
            Route::post('/add', 'CompanyController@store_company')->name('add-company');
        });
        /** User */
        Route::prefix('users')->group(function () {
            Route::get('/', 'UsersmaintainController@index')->name('users');
            Route::post('/user-json', 'UsersmaintainController@get_users_json')->name('user-jsons');
            Route::get('/add', 'UsersmaintainController@addUsers')->name('add-users');
        });
        /** Priviledge Settings */
        Route::prefix('privilege')->group(function () {
            /** Role*/
            Route::prefix('role')->group(function () {
                Route::get('/fetch-role', 'RoleController@index')->name('fetch-role');
                Route::post('/fetch-role', 'RoleController@get_role_json')->name('fetch-role');
                Route::get('/add-role', 'RoleController@view_role')->name('add-role');
                Route::post('/add-role', 'RoleController@store_role')->name('add-role');
                Route::get('/edit-role/{role_id}', 'RoleController@edit_role')->name('edit-role');
                Route::post('/edit-role/{role_id}', 'RoleController@update_role')->name('edit-role');
                Route::delete('/delete-role/{role_id}', 'RoleController@delete_role')->name('delete-role');
            });
            /** Permission*/
            Route::prefix('permission')->group(function () {
                Route::get('/fetch-permission', 'PermissionController@index')->name('fetch-permission');
                Route::post('/fetch-permission', 'PermissionController@get_permission_json')->name('fetch-permission');
                Route::get('/add-permission', 'PermissionController@view_permission')->name('add-permission');
                Route::post('/add-permission', 'PermissionController@store_permission')->name('add-permission');
                Route::delete('/delete-permission/{permission_id}', 'PermissionController@delete_permission')->name('delete-permission');
                Route::get('/edit-permission/{permission_id}', 'PermissionController@edit_permission')->name('edit-permission');
                Route::post('/edit-permission/{permission_id}', 'PermissionController@update_permission')->name('edit-permission');
            });
            /** Licence*/
            Route::prefix('licence')->group(function () {
                Route::get('/fetch-licence', 'LicenceController@index')->name('fetch-licence');
                Route::post('/fetch-licence', 'LicenceController@get_licence_json')->name('fetch-licence');
                Route::get('/add-licence', 'LicenceController@view_licence')->name('add-licence');
                Route::post('/add-licence', 'LicenceController@store_licence')->name('add-licence');
                Route::get('/edit-licence/{licence_id}', 'LicenceController@edit_licence')->name('edit-licences');
                Route::post('/edit-licence/{licence_id}', 'LicenceController@update_licence')->name('edit-licences');
                Route::delete('/delete-licence/{licence_id}', 'LicenceController@delete_licence')->name('delete-licence');
            });
        });
        Route::prefix('common')->group(function () {
            /** Country JSON */
            Route::post('/get-country', 'CommonpanelController@get_country')->name('countries');
            /** State JSON */
            Route::post('/get-state', 'CommonpanelController@get_state')->name('states');
            /** City JSON */
            Route::post('/get-city', 'CommonpanelController@get_city')->name('cities');
            /** Sub City JSON */
            Route::post('/get-sub-city', 'CommonpanelController@get_sub_city')->name('sub-cities');

            Route::prefix('country')->group(function () {
            /** Country */
            Route::get('/fetch-country', 'LocationController@show_country')->name('fetch-countries');
            Route::get('/add-country', 'LocationController@add_country')->name('add-countries');
            Route::post('/add-country', 'LocationController@store_country')->name('add-countries');
            Route::delete('/delete-country/{country_id}', 'LocationController@delete_country')->name('delete-countries');
            Route::get('/edit-country/{country_id}', 'LocationController@edit_country')->name('edit-countries');
            Route::post('/edit-country/{country_id}', 'LocationController@update_country')->name('edit-countries');
            });
            /** State */
            Route::prefix('state')->group(function () {
                Route::get('/fetch-state', 'LocationController@show_state')->name('fetch-states');
                Route::get('/add-state', 'LocationController@add_state')->name('add-states');
                Route::post('/add-state', 'LocationController@store_state')->name('add-states');
                Route::delete('/delete-state/{state_id}', 'LocationController@delete_state')->name('delete-states');
                Route::get('/edit-state/{state_id}', 'LocationController@edit_state')->name('edit-states');
                Route::post('/edit-state/{state_id}', 'LocationController@update_state')->name('edit-states');
            });
            /** City */
            Route::prefix('city')->group(function () {
                Route::get('/fetch-city', 'LocationController@show_city')->name('fetch-cities');
                Route::get('/add-city', 'LocationController@add_city')->name('add-cities');
                Route::post('/add-city', 'LocationController@store_city')->name('add-cities');
                Route::delete('/delete-city/{city_id}', 'LocationController@delete_city')->name('delete-cities');
                Route::get('/edit-city/{city_id}', 'LocationController@edit_city')->name('edit-cities');
                Route::post('/edit-city/{city_id}', 'LocationController@update_city')->name('edit-cities');
            });
            /** Sub City */
            Route::prefix('subcity')->group(function () {
                Route::get('/fetch-sub-city', 'LocationController@show_sub_city')->name('fetch-sub-cities');
                Route::get('/add-sub-city', 'LocationController@add_sub_city')->name('add-sub-cities');
                Route::post('/add-sub-city', 'LocationController@store_sub_city')->name('add-sub-cities');
                Route::delete('/delete-sub-city/{sub_city_id}', 'LocationController@delete_sub_city')->name('delete-sub-cities');
                Route::get('/edit-sub-city/{sub_city_id}', 'LocationController@edit_sub_city')->name('edit-sub-cities');
                Route::post('/edit-sub-city/{sub_city_id}', 'LocationController@update_sub_city')->name('edit-sub-cities');
            });

        });
    });
    // Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/home', 'HomeController@index')->name('home');
});
/** Admin */
Route::group(['middleware' => ['auth','admin']], function () {
    /** Dashboard*/
    Route::get('/admin', 'AdminController@index')->name('admin');
});
/** User */
Route::group(['middleware' => ['auth','user']], function () {
    /** Dashboard*/
    Route::get('/user', 'UserController@index')->name('user');
});

/** */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/permissiondenie', function () {
    return view('errors.403');
})->name('permission-error');
