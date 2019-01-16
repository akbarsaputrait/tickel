<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Petugas extends Authenticatable
{
	use Notifiable;

	protected $table = 'petugass';
	protected $primaryKey = "id_petugas";

	protected $fillable = [
			'username', 'email', 'password',
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'password', 'remember_token',
	];
}
