<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
	use Notifiable, SoftDeletes;

	protected $table = 'admins';

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
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
