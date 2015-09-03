<?php

$app->get('/admin/volunteers', $admin(), function() use ($app) {
	$users = $app->user->where('role','volunteer')->where('is_submitted', true)->where('status', NULL)->get();
	$accept = $app->user->where('role','volunteer')->where('status',4)->get()->count();
	$reject = $app->user->where('role','volunteer')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','volunteer')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','volunteer')->where('status', NULL)->where('is_submitted',true)->get()->count();
	$notify = $app->user->where('role','volunteer')->where('status', '>', 0)->where('is_submitted',true)->where('is_notified',false)->get()->count();

	$app->render('/admin/volunteers/admitVolunteers.php', [
		'users' => $users,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left,
		'notify' => $notify
	]);
	
})->name('admin.volunteer.admit');

$app->get('/admit/volunteer/:userId', $admin(), function($userId) use ($app) {
	$user = $app->user->where('id',$userId)->first();
	$user->update([
		'status' => 4,
	]);
	$app->flash('global', 'Accepted ' . $user->username . '.');
	$app->response->redirect($app->urlFor('admin.volunteer.admit'));

})->name('volunteer.admit');

$app->get('/deny/volunteer/:userId', $admin(), function($userId) use ($app) {
	$user = $app->user->where('id',$userId)->first();
	$user->update([
		'status' => 1,
	]);
		$app->flash('global', 'Denied ' . $user->username . '.');
	$app->response->redirect($app->urlFor('admin.volunteer.admit'));
})->name('volunteer.deny');

$app->get('/admitted/volunteer', $admin(), function() use ($app) {
	$users2 = $app->user->where('role','volunteer')->where('status',4)->get();
	$accept = $app->user->where('role','volunteer')->where('status',4)->get()->count();
	$reject = $app->user->where('role','volunteer')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','volunteer')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','volunteer')->where('status', NULL)->where('is_submitted',true)->get()->count();

	$app->render('/admin/volunteers/admitVolunteers.php' , [
		'users' => $users2,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left
	]);

})->name('volunteer.admitted');
$app->get('/denied/volunteer', $admin(), function() use ($app) {
	$users3 = $app->user->where('role','volunteer')->where('status',1)->get();
	$accept = $app->user->where('role','volunteer')->where('status',4)->get()->count();
	$reject = $app->user->where('role','volunteer')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','volunteer')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','volunteer')->where('status', NULL)->where('is_submitted',true)->get()->count();
	$app->render('/admin/volunteers/admitVolunteers.php' , [
		'users' => $users3,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left
	]);

})->name('volunteer.denied');
$app->get('/notify/volunteer', $admin(), function() use ($app) {
$users = $app->user
	->where('is_notified',false)
	->where('role',"volunteer")
	->where(function($query){
		return $query->where('status',1)->orWhere('status',4);})
	->get();	
	$emails = array();
	if($users2 = $app->user
		->where('is_notified',false)
		->where('role',"volunteer")
		->where(
			function($query){
			return $query->where('status',1)->orWhere('status',4);}
		)->count() == 0) {
		$app->flash('global', 'No updates to send.');
		return $app->response->redirect($app->urlFor('admin.volunteer.admit'));
	}
	if(is_array($users) || is_object($users)) {
		foreach($users as $user) {
			array_push($emails, $user->email);
			$user->update ([
				'is_notified' => true
			]);
		}
		$body = "An update has been posted to your sohacks portal. Please visit www.sohacks.com and navigate to the place where you registered.";
		$subject = "Your SoHacks 2 Registration Notification";
		$app->mail->notice('Hi ' . '<br>' . $body, [], function ($message) use ($emails,$subject) {
			$message->setto($emails);
			$message->subject($subject);
		});
		$app->flash('global', 'Sent.');
		$app->response->redirect($app->urlFor('admin.volunteer.admit'));
	}

})->name('volunteer.notify');
