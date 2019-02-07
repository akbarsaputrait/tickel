<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $primaryKey = "id_pemesanan";
    protected $table = 'pemesanans';

    public function rute() {
      return $this->hasOne('App\Rute', 'id_rute', 'id_rute');
    }

    public function petugas() {
      return $this->hasOne('App\Petugas', 'id_petugas', 'id_petugas');
    }
}
