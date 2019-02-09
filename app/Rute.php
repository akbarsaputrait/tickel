<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rute extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = "id_rute";
    protected $table = "rutes";

    public function transportasi() {
      return $this->hasOne('App\Transportasi', 'id_transportasi', 'id_transportasi');
    }

    public function type() {
      return $this->hasOne('App\TypeRute', 'id_type_rute', 'id_type_rute');
    }

    public function typetrans() {
      return $this->hasOne('App\TypeTransportasi', 'id_type_transportasi', 'id_transportasi');
    }

}
