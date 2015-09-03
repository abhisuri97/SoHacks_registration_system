<?php

use sohacks\User\UserPermission;

$app->get('/signup' , $guest(), function() use ($app) {
	$app->render('auth/register.php');
})->name('register');

$app->post('/signup', $guest(), function() use ($app) {
	
	$request = $app->request;

	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');
	$role = $request->post('role');

	$v = $app->validation;

	$v->validate([
		'email' => [$email, 'required|email|uniqueEmail'],
		'username' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
		'role' => [$role, 'required|min(6)']
	]);

	if($v->passes()) {

			$identifier = $app->randomlib->generateString(128);
			$user = $app->user->create([
				'email' => $email,
				'username' => $username,
				'role' => $role,
				'password' => $app->hash->password($password),
				'active' => false,
				'active_hash' => $app->hash->hash($identifier)
			]);

			$user->permissions()->create(UserPermission::$defaults);

			$app->mail->send('email/auth/registered.php', ['user'=> $user, 'identifier'=> $identifier], function ($message) use ($user) {
				$message->to($user->email);
				$message->subject('Thanks for registering.');
			});
			$_SESSION[$app->config->get('auth.session')] = $user->id;
			$app->flash('global', 'Registered! Check your email for an activation link. You need it to sign into your account in the future!');
			$app->response->redirect($app->urlFor('home'));
	} 
	$app->render('auth/register.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);
	
})->name('register.post');