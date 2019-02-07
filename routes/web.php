<?php
Auth::routes();

Route::group(['middleware'=>'guest'], function() {
  Route::get('/', 'HomeController@index')->name('home');

  // AUTH ADMIN
  Route::get('/admin/masuk', 'AdminController@showLoginForm')->name('admin.login');
  Route::post('/admin/masuk', 'AdminController@loginAdmin')->name('admin.login.post');

  // AUTH PETUGAS
  Route::get('/petugas/masuk', 'PetugasController@showLoginForm')->name('petugas.login');
  Route::post('/petugas/masuk', 'PetugasController@loginPetugas')->name('petugas.login.post');
  Route::get('/petugas/keluar', 'PetugasController@logoutPetugas')->name('petugas.logout');

  // AUTH PENUMPANG
  Route::get('/penumpang/masuk', 'PenumpangController@showLoginForm')->name('penumpang.login');
  Route::post('/penumpang/masuk', 'PenumpangController@loginPenumpang')->name('penumpang.login.post');
  Route::get('/penumpang/keluar', 'PenumpangController@logoutPenumpang')->name('penumpang.logout');
  Route::get('/penumpang/daftar', 'PenumpangController@registerForm')->name('penumpang.register');
  Route::post('/penumpang/daftar', 'PenumpangController@registerPost')->name('penumpang.register.post');

  Route::post('/pesan-tiket/proses', 'PesanTiketController@pesanTiket')->name('pesan.store');
  Route::get('/pesan-tiket', 'PesanTiketController@formPesanTiket')->name('pesan.create');
});

//ADMIN
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
  Route::get('/admin/keluar', 'AdminController@logoutAdmin')->name('admin.logout');
  Route::get('/admin/dasbor', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::resource('petugas', 'Admin\PetugasController', ['as' => 'admin']);
  Route::resource('rute', 'Admin\RuteController', ['as' => 'admin']);
  Route::resource('transportasi', 'Admin\TransportasiController', ['as' => 'admin']);
  Route::resource('tipe-transportasi', 'Admin\TypeTransportasiController', ['as' => 'admin']);
  Route::resource('tipe-rute', 'Admin\TypeRuteController', ['as' => 'admin']);
  Route::resource('level', 'Admin\LevelController', ['as' => 'admin']);
  Route::resource('order', 'Admin\OrderController', ['as' => 'admin']);
  Route::get('admin/level/hapus/{id}', 'Admin\LevelController@destroy');
  Route::get('admin/petugas/hapus/{id}', 'Admin\PetugasController@destroy');
  Route::get('admin/tipe-transportasi/hapus/{id}', 'Admin\TypeTransportasiController@destroy');
  Route::get('admin/transportasi/hapus/{id}', 'Admin\TransportasiController@destroy');
  Route::get('admin/rute/hapus/{id}', 'Admin\RuteController@destroy');
  Route::get('admin/tipe-rute/hapus/{id}', 'Admin\TypeRuteController@destroy');
  Route::get('admin/profil', 'Admin\ProfileController@index')->name('admin.profile');
  Route::post('admin/profil/store', 'Admin\ProfileController@updateProfile')->name('admin.profile.store');
  Route::post('admin/profil/ganti-password', 'Admin\ProfileController@resetPassword')->name('admin.profile.reset');
});

// PETUGAS
Route::group(['middleware' => 'petugas'], function() {
  Route::get('petugas/dasbor', 'Petugas\DashboardController@index')->name('petugas.dashboard');
  Route::resource('petugas/order', 'Petugas\OrderController', ['as' => 'petugas']);
  Route::get('petugas/profil', 'Petugas\ProfileController@index')->name('petugas.profile');
  Route::post('petugas/profil/store', 'Petugas\ProfileController@updateProfile')->name('petugas.profile.store');
  Route::post('petugas/profil/ganti-password', 'Petugas\ProfileController@resetPassword')->name('petugas.profile.reset');
});

// PENUMPANG
Route::group(['middleware' => 'penumpang'], function() {
  Route::get('/profil/{username}', 'Penumpang\ProfilController@profilShow')->name('profile.show');
  Route::post('/profil/{username}/update', 'Penumpang\ProfilController@profilUpdate')->name('profile.update');

  Route::get('/tiket/{id_pemesanan}/', 'PembayaranController@show')->name('pembayaran.show');
  Route::post('/tiket/update/{id_pemesanan}', 'PembayaranController@update')->name('pembayaran.update');
});
