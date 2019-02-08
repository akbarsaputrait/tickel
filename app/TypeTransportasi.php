<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeTransportasi extends Model
{
  use SoftDeletes;
    protected $table = "type_transportasi";
    protected $primaryKey = "id_type_transportasi";

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
