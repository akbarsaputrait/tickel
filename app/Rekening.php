<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekening extends Model
{
		use SoftDeletes;
    protected $table = "rekenings";
		protected $primaryKey = "id_rekening";
		protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
