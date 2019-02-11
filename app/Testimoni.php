<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimoni extends Model
{
	use SoftDeletes;
	protected $table = "Testimoni";
	protected $primaryKey = "id";
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function user() {
		return $this->hasOne('App\Penumpang', 'id_penumpang', 'id_user');
	}
}
