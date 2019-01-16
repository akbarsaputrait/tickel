<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $primaryKey = "id_transportasi";

    public function jenis() {
      return $this->hasOne('App\TypeTransportasi', 'id_type_transportasi', 'id_type_transportasi');
    }
}
