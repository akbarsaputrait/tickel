<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pemesanan extends Model
{
  use SoftDeletes, Notifiable;
    protected $primaryKey = "id_pemesanan";
    protected $table = 'pemesanans';

    public function rute() {
      return $this->hasOne('App\Rute', 'id_rute', 'id_rute');
    }

    public function petugas() {
      return $this->hasOne('App\Petugas', 'id_petugas', 'id_petugas');
    }

    public function pelanggan() {
      return $this->hasOne('App\Penumpang', 'id_penumpang', 'id_pelanggan');
    }

    public function admin() {
      return $this->hasOne('App\Admin', 'id', 'id_admin');
    }

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
