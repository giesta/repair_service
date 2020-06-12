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

Route::get('/', function () {
    return view('auth/login');
});
//Route::get('/uploadfile', 'UploadfileController@index');
//Route::post('/uploadfile', 'UploadfileController@upload');
Route::get('login', 'LoginController@index');
Route::post('checklogin', 'LoginController@checklogin');
Route::get('successlogin', 'LoginController@successlogin');
Route::get('logout', 'LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('/roles','RoleController');
    Route::resource('/users','UserController');
    Route::resource('/devices','DeviceController');
    
});
Route::post('/devices/takenBack/{id}', 'DeviceController@takenBack')->name('devices.takenBack');
Route::post('/devices/repaired/{id}', 'DeviceController@repaired')->name('devices.repaired');
Route::get('/devices/reports/filter', 'DeviceController@filter')->name('devices.filter');
Route::post('/devices/report', 'DeviceController@report')->name('devices.report');