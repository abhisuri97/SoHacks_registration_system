<?php

$app->get('/activate', function() use ($app) {	
		$request=$app->request;
		$email = $request->get('email');
		$identifier = $request->get('identifier');

		$hashedIdentifier = $app->hash->hash($identifier);

		$user = $app->user->where('email', $email)
			->where('active',false)
			->first();
		$userActivated = $app->user->where('email', $email)
			->where('active',true)
			->first();
		if(!$user || $user->active_hash == NULL || !$app->hash->hashCheck($hashedIdentifier, $user->active_hash)) {
			$app->flash('global', 'Error: Please log in and check if you are activated. If not, click "Resend Activation"');
			$mode = "login";
			$app->response->redirect($app->urlFor('home'));
		}
		else {
			$user2 = $user;
			$user->activateAccount();
			$app->flash('global', 'Your account has been activated');
			$app->response->redirect($app->urlFor('home'));
			$app->mail->send('email/auth/registerConfirm.php', ['user'=> $user2, 'identifier'=> $identifier], function ($message) use ($user) {
					$message->to($user->email);
					$message->subject('You have registered');
			});
		}
		
})->name('activate');

$app->get('/resend', $notactive(), function() use ($app) {	
			$identifier = $app->randomlib->generateString(128);
			$user = $app->auth->update([
				'active_hash' => $app->hash->hash($identifier)
			]);

			$app->mail->send('email/auth/registered.php', ['user'=> $app->auth, 'identifier'=> $identifier], function ($message) use ($app) {
				$message->to($app->auth->email);
				$message->subject('SoHacks Registration - Almost done!');
			});
			$app->flash('global', 'Resent your email to ' . $app->auth->email . '. Check your inbox for an email from register@sohacks.com');
			$app->response->redirect($app->urlFor('home'));	
})->name('resend');