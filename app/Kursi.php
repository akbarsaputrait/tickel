<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kursi extends Model
{
  use SoftDeletes;
    protected $table = "kursis";
		protected $primaryKey = "id_kursi";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
