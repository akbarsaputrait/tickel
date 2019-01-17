<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $primaryKey = "id_rute";

    public function transportasi() {
      return $this->hasOne('App\Transportasi', 'id_transportasi', 'id_transportasi');
    }

    public function type() {
      return $this->hasOne('App\TypeRute', 'id_type_rute', 'id_type_rute');
    }
}
