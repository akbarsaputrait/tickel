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
    // dd(bcrypt("yudha"));
});

Auth::routes();

//ADMIN
Route::group(['middleware' => 'admin'], function() {
  Route::get('/admin/logout', 'AdminController@logoutAdmin')->name('admin.logout');
  Route::get('/admin/dasbor', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::resource('admin/petugas', 'Admin\PetugasController');
  Route::resource('admin/rute', 'Admin\RuteController');
  Route::resource('admin/transportasi', 'Admin\TransportasiController');
  Route::resource('admin/tipe-transportasi', 'Admin\TypeTransportasiController');
  Route::resource('admin/tipe-rute', 'Admin\TypeRuteController');
  Route::resource('admin/level', 'Admin\LevelController');
  Route::resource('admin/order', 'Admin\OrderController');
  Route::get('admin/level/hapus/{id}', 'Admin\LevelController@destroy');
  Route::get('admin/petugas/hapus/{id}', 'Admin\PetugasController@destroy');
  Route::get('admin/tipe-transportasi/hapus/{id}', 'Admin\TypeTransportasiController@destroy');
  Route::get('admin/transportasi/hapus/{id}', 'Admin\TransportasiController@destroy');
  Route::get('admin/rute/hapus/{id}', 'Admin\RuteController@destroy');
  Route::get('admin/tipe-rute/hapus/{id}', 'Admin\TypeRuteController@destroy');
});

// PETUGAS
Route::group(['middleware' => 'petugas'], function() {
  Route::get('/petugas/dasbor', 'Petugas\DashboardController@index')->name('petugas.dashboard');
  Route::resource('petugas/order', 'Petugas\OrderController');
});

// PENUMPANG
Route::group(['middleware' => 'penumpang'], function() {
  Route::get('/penumpang/dasbor', 'Penumpang\DashboardController@index')->name('penumpang.dashboard');
});

Route::group(['middleware'=>'guest'], function() {
  // AUTH ADMIN
  Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login');
  Route::post('/admin/login', 'AdminController@loginAdmin')->name('admin.login.post');

  // AUTH PETUGAS
  Route::get('/petugas/login', 'PetugasController@showLoginForm')->name('petugas.login');
  Route::post('/petugas/login', 'PetugasController@loginPetugas')->name('petugas.login.post');
  Route::get('/petugas/logout', 'PetugasController@logoutPetugas')->name('petugas.logout');

  // AUTH PENUMPANG
  Route::get('/penumpang/login', 'PenumpangController@showLoginForm')->name('penumpang.login');
  Route::post('/penumpang/login', 'PenumpangController@loginPenumpang')->name('penumpang.login.post');
  Route::get('/penumpang/logout', 'PenumpangController@logoutPenumpang')->name('penumpang.logout');
  Route::get('/penumpang/register', 'PenumpangController@registerForm')->name('penumpang.register');
  Route::post('/penumpang/register', 'PenumpangController@registerPost')->name('penumpang.register.post');

});

// Route::group(['guard'=>'admin'], function() {
//
//
// });
//
// Route::group(['middleware'=>'auth:petugas'], function() {
//   Route::get('/petugas/dashboard', 'PetugasController@dashboard')->name('petugas.dashboard');
// });
//
// Route::group(['middleware'=>'penumpang'], function() {
//   Route::get('/penumpang/dashboard', 'PenumpangController@dashboard')->name('penumpang.dashboard');
// });
