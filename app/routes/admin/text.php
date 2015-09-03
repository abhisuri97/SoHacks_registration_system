<?php

$app->get('/admin/text', $admin(), function() use ($app){
	$app->render('/admin/text.php');

})->name('text');
$app->post('/admin/textsend', $admin(), function() use ($app) {
	$request = $app->request;
	$target = $request->post('group');
	if($target==1) {
		$users = $app->user->whereNotNull('eventphone')->where('status','2')->get();
	}
	if($target==2) {
		$users = $app->user->whereNotNull('eventphone')->where('status','5')->get();
	}
	if($target==3) {
		$users = $app->user->whereNotNull('eventphone')->where('status','4')->get();
	}
	if($target==4) {
		$users = $app->user->whereNotNull('eventphone')->where('status','2')->orWhere('status','4')->get();
	}
	if($target==5) {
		$users = $app->user->whereNotNull('eventphone')->where('status','2')->orWhere('status','5')->get();
	}
	if($target==6) {
		$users = $app->user->whereNotNull('eventphone')->where('status','4')->orWhere('status','5')->get();
	}
	if($target==7) {
		$users = $app->user->whereNotNull('eventphone')->where('status','4')->orWhere('status','5')->orWhere('status','2')->get();
	}
	$body = $request->post('body');
	$numbers = array();
	if(is_array($users) || is_object($users)) {
		foreach($users as $user) {
			array_push($numbers, $user->eventphone);
		}
	}
	$count = 0;
	$errorIds = array();
	foreach($numbers as $number) {
		try {
			$app->text->text("+12105260642", $number,"Recipient Number:".$count."---".$body);
			$count++;
		} catch (Exception $e) {
			array_push($errorIds, $number);
		}	
	}
		$app->flash('global', 'An text has been sent to '.$count.' individuals. Errors for the following users:'. implode(',',$errorIds).'.End Message');
	$app->response->redirect($app->urlFor('text'));	
})->name('text.send');