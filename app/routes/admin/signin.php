<?php

$app->get('/signin', $authenticated, function() use ($app){
	$app->render('admin/signin.php');


})->name('signin');


$app->post('/signininfo', $authenticated, function() use ($app){
	$request = $app->request;
	$term = strtolower($request->post('keyword'));
	$data = $app->user->where('username','LIKE',$term.'%')->orWhere('first_name','LIKE',$term.'%')->orWhere('last_name','LIKE',$term.'%')->orWhere('email','LIKE',$term.'%')->take(10)->get();
		$test = array();

	foreach($data as $user) {
			array_push($test, $user->username.'____'.$user->first_name.'____'.$user->last_name);
		}
	// $data = array("alpaca", "buffalo", "cat", "tiger");
	echo json_encode($test);


})->name('signininfo');