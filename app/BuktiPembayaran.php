<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $primaryKey = 'id_bukti';
		protected $table = 'bukti_pembayaran';
}
