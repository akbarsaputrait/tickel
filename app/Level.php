<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
  use SoftDeletes;
    protected $primaryKey = "id_level";
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
