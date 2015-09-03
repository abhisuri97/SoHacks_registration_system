<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Team extends Eloquent
{
	protected $table = 'teams';

	protected $fillable = [
		'user_id',
		'team_name',
		'project',
		'user1',
		'user2',
		'user3',
		'user4',
		'invite',
	];


}