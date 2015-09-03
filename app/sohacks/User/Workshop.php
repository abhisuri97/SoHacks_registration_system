<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Workshop extends Eloquent
{
	protected $table = 'workshops';

	protected $fillable = [
		'workshop',
		'desc',
		'tools',
		'max',
		'count'
	];
}