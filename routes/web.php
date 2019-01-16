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
    return view('welcome');
});

// Auth::routes();

Route::group(['middleware'=>'guest'], function() {
  // AUTH ADMIN
  Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login');
  Route::post('/admin/login', 'AdminController@login')->name('admin.login.post');
  Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

  Route::get('/admin/dashboard', 'Admin\DashboardController@index');
  Route::resource('admin/petugas', 'Admin\PetugasController');
  Route::resource('admin/rute', 'Admin\RuteController');
  Route::resource('admin/transportasi', 'Admin\TransportasiController');
  Route::resource('admin/type-transportasi', 'Admin\TypeTransportasiController');
  Route::resource('admin/level', 'Admin\LevelController');
  Route::resource('admin/order', 'Admin\OrderController');

  Route::get('admin/level/delete/{id}', 'Admin\LevelController@destroy');
  Route::get('admin/petugas/delete/{id}', 'Admin\PetugasController@destroy');
  Route::get('admin/type-transportasi/delete/{id}', 'Admin\TypeTransportasiController@destroy');
  Route::get('admin/transportasi/delete/{id}', 'Admin\TransportasiController@destroy');


  // AUTH PETUGAS
  Route::get('/petugas/login', 'PetugasController@showLoginForm')->name('petugas.login');
  Route::post('/petugas/login', 'PetugasController@login')->name('petugas.login.post');
  Route::get('/petugas/logout', 'PetugasController@logout')->name('petugas.logout');

  Route::get('/petugas/dashboard', 'Petugas\DashboardController@index');
  Route::resource('petugas/order', 'Petugas\OrderController');

  // AUTH PENUMPANG
  Route::get('/penumpang/login', 'PenumpangController@showLoginForm')->name('penumpang.login');
  Route::post('/penumpang/login', 'PenumpangController@login')->name('penumpang.login.post');
  Route::get('/penumpang/logout', 'PenumpangController@logout')->name('penumpang.logout');

});

// Route::group(['middleware'=>'auth:admin'], function() {
//   Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
// });
//
// Route::group(['middleware'=>'auth:petugas'], function() {
//   Route::get('/petugas/dashboard', 'PetugasController@dashboard')->name('petugas.dashboard');
// });
//
// Route::group(['middleware'=>'penumpang'], function() {
//   Route::get('/penumpang/dashboard', 'PenumpangController@dashboard')->name('penumpang.dashboard');
// });
