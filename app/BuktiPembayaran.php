<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuktiPembayaran extends Model
{
  use SoftDeletes;
    protected $primaryKey = 'id_bukti';
		protected $table = 'bukti_pembayaran';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
