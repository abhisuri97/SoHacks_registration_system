<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Usershift extends Eloquent
{
	protected $table = 'usershifts';

	protected $fillable = [
		'user_id',
		'shift_id',
		'user_email'
	];


}