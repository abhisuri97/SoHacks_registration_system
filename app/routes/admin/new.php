<?php
use Carbon\Carbon;
use sohacks\User\UserPermission;

$app->get('/new' , function() use ($app) {
	$app->render('admin/new.php');
})->name('adminnew');

$app->post('/newpost', function() use ($app) {

	$request = $app->request;
	$signin = $request->post('signin');
	$signout = $request->post('signout');
	$username = $request->post('username');
	$email = $request->post('email');
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');
	$email = $request->post('email');
	$phone = $request->post('phone');
	$allergies = $request->post('allergies');
	$laptop = $request->post('laptop');
	$eventphone = $request->post('eventphone');
	$role = $request->post('role');
	if($role == "attendee") {
		$status=2;
	}
	if($role == "mentor") {
		$status=5;
	}
	if($role == "volunteer") {
		$status=4;
	}
	if($signin) {
		$mytime = Carbon::now();
		$newtime = $mytime->toDateTimeString();

		$user1 = $app->user->create([
			'username' => $username,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'email' => $email,
			'phone' => $phone,
			'eventphone' => $eventphone,
			'allergies' => $allergies,
			'laptop'=> $laptop,
			'is_here' => true,
			'times' => $newtime,
			'status' => $status,
			'is_notified' => true,
			'is_attending' => true,
			'active' => true,
			'is_submitted' => true,
			'password' => $app->hash->password($username)

		]);
		$user1->permissions()->create(UserPermission::$defaults);

	$app->sign->specsign($email, "SoHacks Waiver");
	$user = $app->user->where('email',$email);
	$user->update([
		'sent_signature' => true
	]);
		$app->flash('global', 'User Signed In.');
	}
	$app->response->redirect($app->urlFor('signin'));

	
	
})->name('new.post');