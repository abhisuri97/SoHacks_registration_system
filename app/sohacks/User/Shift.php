<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Shift extends Eloquent
{
	protected $table = 'shifts';

	protected $fillable = [
		'shift',
		'for',
		'desc',
		'count',
	];
}