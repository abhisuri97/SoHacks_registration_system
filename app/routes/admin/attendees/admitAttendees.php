<?php

$app->get('/admin/attendees', $admin(), function() use ($app) {
	$users = $app->user->where('role','attendee')->where('is_submitted', true)->where('status', NULL)->get();
	$accept = $app->user->where('role','attendee')->where('status', 2)->get()->count();
	$reject = $app->user->where('role','attendee')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','attendee')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','attendee')->where('status', NULL)->where('is_submitted',true)->get()->count();
	$notify = $app->user->where('role','attendee')->where('status', '>', 0)->where('is_submitted',true)->where('is_notified',false)->get()->count();

	$app->render('/admin/attendees/admitAttendees.php', [
		'users' => $users,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left,
		'notify' => $notify
	]);
	
})->name('admin.admit');

$app->get('/admit/:userId', $admin(), function($userId) use ($app) {
	$user = $app->user->where('id',$userId)->first();
	$user->update([
		'status' => 2,
	]);
	$app->flash('global', 'Accepted ' . $user->username . '.');
	$app->response->redirect($app->urlFor('admin.admit'));

})->name('admit');

$app->get('/deny/:userId', $admin(), function($userId) use ($app) {
	$user = $app->user->where('id',$userId)->first();
	$user->update([
		'status' => 1,
	]);
		$app->flash('global', 'Denied ' . $user->username . '.');
	$app->response->redirect($app->urlFor('admin.admit'));	
})->name('deny');

$app->get('/admitted', $admin(), function() use ($app) {
	$users2 = $app->user->where('role','attendee')->where('status',2)->get();
	$accept = $app->user->where('role','attendee')->where('status', 2)->get()->count();
	$reject = $app->user->where('role','attendee')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','attendee')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','attendee')->where('status', NULL)->where('is_submitted',true)->get()->count();

	$app->render('/admin/attendees/admitAttendees.php' , [
		'users' => $users2,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left
	]);

})->name('admitted');
$app->get('/denied', $admin(), function() use ($app) {
	$users3 = $app->user->where('role','attendee')->where('status',1)->get();
	$accept = $app->user->where('role','attendee')->where('status', 2)->get()->count();
	$reject = $app->user->where('role','attendee')->where('status', 1)->get()->count();
	$applied = $app->user->where('role','attendee')->where('is_submitted', true)->get()->count();
	$left = $app->user->where('role','attendee')->where('status', NULL)->where('is_submitted',true)->get()->count();
	$app->render('/admin/attendees/admitAttendees.php' , [
		'users' => $users3,
		'accept' => $accept,
		'reject' => $reject,
		'applied' => $applied,
		'left' => $left
	]);

})->name('denied');
$app->get('/notify/attendee', $admin(), function() use ($app) {
	$users = $app->user
	->where('is_notified',false)
	->where('role',"attendee")
	->where(function($query){
		return $query->where('status',1)->orWhere('status',2);})
	->get();
	$emails = array();
	if($users2 = $app->user
		->where('is_notified',false)
		->where('role',"attendee")
		->where(
			function($query){
			return $query->where('status',1)->orWhere('status',2);}
		)->count() == 0) {
		$app->flash('global', 'No updates to send.');
		return $app->response->redirect($app->urlFor('admin.admit'));
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
		return $app->response->redirect($app->urlFor('admin.admit'));
	}

})->name('notify.attendees');
