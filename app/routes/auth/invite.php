<?php
$app->get('/auth/invite', $authenticated(), function() use ($app){

	 $app->render('auth/invite.php');

})->name('invite');
$app->post('/auth/invite', $authenticated(), function() use ($app) {
	
	$request = $app->request;
	$to = $request->post('to');
	$v = $app->validation;

	$v->validate([
		'email' => [$to, 'required|email|uniqueEmail'],
	]);
	if($v->passes()) {
			$test = $app->auth->invited;
			$test = $test + 1;
			$user = $app->auth->update([
				'invited' => $test
			]);
			$user = $app->auth->getFullNameOrUsername();
			$app->mail->send('email/auth/invited.php', ['user'=> $user], function ($message) use ($to) {
				$message->to($to);
				$message->subject('You have been invited to SoHacks.');
			});
			$app->flash('global', 'You have sent an invitation to ' . $to . '.');
			$app->response->redirect($app->urlFor('home'));	
	} 
	
	$app->render('auth/invite.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);

})->name('invite.post');