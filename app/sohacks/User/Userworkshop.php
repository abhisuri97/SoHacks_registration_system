<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Userworkshop extends Eloquent
{
	protected $table = 'userworkshops';

	protected $fillable = [
		'user_id',
		'workshop_id',
		'user_email'
	];


}