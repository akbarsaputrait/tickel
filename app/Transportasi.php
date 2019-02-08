<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportasi extends Model
{
  use SoftDeletes;
    protected $primaryKey = "id_transportasi";

    public function jenis() {
      return $this->hasOne('App\TypeTransportasi', 'id_type_transportasi', 'id_type_transportasi');
    }
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
