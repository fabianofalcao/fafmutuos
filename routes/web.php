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

Route::get('/', 'Front\SiteController@index');
Route::resource('/users', 'Front\UserController');

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth']], function (){
    Route::get('/', 'AdminController@home')->name('home');

    Route::any('usuarios/search', 'UserController@search')->name('users.search');
    Route::resource('/users', 'UserController');

    Route::any('jobs/search', 'JobController@search')->name('jobs.search');
    Route::resource('/jobs', 'JobController');

    Route::any('economic_setors/search', 'EconomicSetorController@search')->name('economic_setors.search');
    Route::resource('/economic_setors', 'EconomicSetorController');

    Route::any('debtors/search', 'DebtorController@search')->name('debtors.search');
    Route::resource('/debtors', 'DebtorController');

    Route::any('creditors/search', 'CreditorController@search')->name('creditors.search');
    Route::resource('/creditors', 'CreditorController');
});

