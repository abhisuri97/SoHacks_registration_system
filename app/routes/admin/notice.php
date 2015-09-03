<?php
$app->get('/admin/notice', $admin(), function() use ($app){

	 $app->render('admin/notice.php');

})->name('notice');
$app->post('/admin/notice', $admin(), function() use ($app) {
	
	$request = $app->request;

	$to = $request->post('to');
	$subject = $request->post('subject');
	$body = $request->post('body');

	//Applied
	if($to == "ALL:SIGNUP") {
		$users = $app->user->where('active',true)->where('status',NULL)->where('is_submitted',false)->get();
	}
	if($to == "ALL:APPLIED") {
		$users = $app->user->where('active',true)->where('status',NULL)->where('is_submitted',true)->get();
	}
	if($to == "ALL:STUAPPLIED") {
		$users = $app->user->where('active',true)->where('status',NULL)->where('is_submitted',true)->where('role',"attendee")->get();
	}
	if($to == "ALL:MENAPPLIED") {
		$users = $app->user->where('active',true)->where('status',NULL)->where('is_submitted',true)->where('role',"mentor")->get();
	}
	if($to == "ALL:VOLAPPLIED") {
		$users = $app->user->where('active',true)->where('status',NULL)->where('is_submitted',true)->where('role',"volunteer")->get();
	}

	//Decided
	if($to == "ALL:DECIDED") {
		$users = $app->user->where('active',true)->where('is_notified',true)->get();
	}
	//attendees
	if($to == "ALL:STUACCEPTED") {
		$users = $app->user->where('active',true)->where('status',2)->get();
	}
	if($to == "ALL:STUDENIED") {
		$users = $app->user->where('active',true)->where('status',1)->where('role',"attendee")->get();
	}
	//mentors
	if($to == "ALL:MENACCEPTED") {
		$users = $app->user->where('active',true)->where('status',5)->get();
	}
	if($to == "ALL:MENDENIED") {
		$users = $app->user->where('active',true)->where('status',1)->where('role',"mentor")->get();
	}
	//volunteers
	if($to == "ALL:VOLACCEPTED") {
		$users = $app->user->where('active',true)->where('status',4)->get();
	}
	if($to == "ALL:VOLDENIED") {
		$users = $app->user->where('active',true)->where('status',1)->where('role',"volunteer")->get();
	}
	//general
	if($to == "ALL:ACCEPTED") {
		$users = $app->user->where('active',true)->where('status','>',1)->get();
	}
	if($to == "ALL:DENIED") {
		$users = $app->user->where('active',true)->where('status',1)->get();
	}

	//attending
	if($to == "ALL:STUATTENDING") {
		$users = $app->user->where('active',true)->where('status',2)->where('is_attending',1)->get();
	}
	if($to == "ALL:VOLATTENDING") {
		$users = $app->user->where('active',true)->where('status',4)->where('is_attending',1)->get();
	}
	if($to == "ALL:MENATTENDING") {
		$users = $app->user->where('active',true)->where('status',5)->where('is_attending',1)->get();
	}
	if($to == "ALL:ATTENDING") {
		$users = $app->user->where('active',true)->where('is_attending',1)->get();		
	}
	$emails = array();
	if(is_array($users) || is_object($users)) {
		foreach($users as $user) {
			array_push($emails, $user->email);
		}
		$app->mail->notice('Hi ' . '<br>' . $body, [], function ($message) use ($emails,$subject) {
			$message->setto($emails);
			$message->subject($subject);
		});
		$app->flash('global', 'Sent.');
		$app->response->redirect($app->urlFor('notice'));
	}
	
	

})->name('notice.post');