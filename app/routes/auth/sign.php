<?php

$app->get('/auth/sign', $authenticated(), function() use ($app){
	$app->render('/auth/sign.php');

})->name('sign');
$app->get('/auth/sign/send', function() use ($app) {
	$app->sign->sign($app->auth->email, $app->auth->getFullNameOrUsername());
	$app->flash('global', 'An email has been sent to you from noreply@mail.hellosign.com with the details on how to sign');
	$app->response->redirect($app->urlFor('sign'));	
	$app->auth->update([
		'sent_signature' => true
	]);
})->name('sign.send');
$app->post('/auth/sign/sendspec', function() use ($app) {
	$request = $app->request;
	$email = $request->post('email');
	$app->sign->specsign($email, "SoHacks Waiver");
	$user = $app->user->where('email',$email);
	$user->update([
		'sent_signature' => true
	]);
	echo json_encode('An email has been sent to you from noreply@mail.hellosign.com with the details on how to sign');
	
})->name('sign.sendspec');
$app->post('/auth/sign', function() use ($app) {
	$app->response->headers->set('status','200 OK');
	$app->response->headers->set('Content-type','application/json');
	echo "Hello API Event Received";
	$params = $app->request->params();
	$event = json_decode($params['json'],true);
	if($event['event']['event_type']=="signature_request_signed") {
		$foo = $event['event']['event_metadata']['related_signature_id'];
		$user = $app->user->where('signature_id',$foo)->get()->first();
		$user->update([
		'is_signed'=>true
		]);
	}
	
})->name('sign.post');
$app->post('/auth/signcheck', function() use ($app) {
	$request = $app->request;
	$email = $request->post('email');
	$user = $app->user->where('email',$email);
	if($app->user->where('email',$email)->pluck('is_signed') == true) {
		echo json_encode("Signed");
	}
	else {
		$app->response->headers->set('status','500 ERROR');
		$app->response->headers->set('Content-type','application/json');
	}
	
})->name('sign.check');
//IMPLEMENT LATER