<?php 

return [
	'app' => [
		'url' => 'http://sohacks.com',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		]
	],
	'db' => [
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'name' => 'site',
		'username' => 'root',
		'password' => '807Crowd',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => ''
	],
	'auth' => [
		'session' => 'user_id',
		'remember' => 'user_r'
	],
	'mail' => [
		'username' => 'suriabhinav',
		'password' => '807Crowd',
		'from' => 'register@sohacks.com'
	],
	'sign' => [
		'api' =>'5541401e1c0774f10544c48a229754136901d3efc27bd511ed75bcac0c6cd4af',
		'template' => 'e20979f499dea7355f5fe33e4070f518dd5106fe'
	],
	'twig' => [
		'debug' => true
	],
	'csrf' => [
		'key' => 'csrf_token'
	]
];