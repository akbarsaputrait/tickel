<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Penumpang extends Authenticatable
{
	use Notifiable;

	protected $table = 'penumpangs';
	protected $primaryKey = "id_penumpang";

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
