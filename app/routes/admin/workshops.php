<?php
$app->get('/workshops', $authenticated, function() use ($app){
	$joined = $app->workshop
		->join('userworkshops', 'workshops.id','=','userworkshops.workshop_id')
		->get();
	$users = $app->user
		->join('userworkshops','users.id', '=', 'userworkshops.user_id')
		->get();
	$list = $app->workshop->get();
	$count = $app->workshop->join('userworkshops', 'workshops.id','=','userworkshops.workshop_id')->get()->count();
	$app->render('admin/workshops.php', [
		'count' => $count,
		'users' =>$users,
		'joined' => $joined,
		'list' => $list,
	]);

})->name('workshops');

$app->post('/workshops', $authenticated, function() use ($app){
		$request = $app->request;
		$workshop = $request->post('workshop');
		$tools = $request->post('tools');
		$desc = $request->post('desc');
		$max = $request->post('max');
		$app->workshop->create([
			'workshop' => $workshop,
			'tools' => $tools,
			'desc' => $desc,
			'max' => $max,
			'count' => 0
		]);
	$app->flash('global','added');
	$app->redirect($app->urlFor('workshops'));
})->name('workshops.add');

$app->get('/workshopsdelete/:id', $admin(), function($id) use ($app){
	$app->workshop->where('id', $id)->delete();
	$app->flash('global','deleted');
	$app->redirect($app->urlFor('workshops'));
})->name('workshops.delete');


$app->get('/workshopssignup/:id', $authenticated(), function($id) use ($app){
	$test = $app->workshop->where('id',$id)->pluck('count');
			$test = $test + 1;
	
	if($app->workshop->where('id',$id)->pluck('max') >= $test) {
			
			$joined = $app->userworkshop
				->create([
					'workshop_id' => $id,
					'user_id' => $app->auth->username,
					'user_email' =>$app->auth->email
				]);
			$app->workshop->where('id', $id)->update([
				'count' => $test
			]);
			$app->flash('global','signed up');
			$app->redirect($app->urlFor('workshops'));
		
		
	}
	else {
		$app->flash('global','This workshop is full or an error occured.');
			$app->redirect($app->urlFor('workshops'));
	}
})->name('workshops.signup');
// $app->post('/shiftssignup', $authenticated(), function() use ($app) {
// 	$req = $app->request();
// 	$id = $req->post('id');
// 	$test = $app->shift->where('id',$id)->pluck('count');
// 	$test = $test + 1;
	
// 	if($app->shift->where('id',$id)->pluck('for') != 6) {
// 		if($app->shift->where('id',$id)->pluck('for') == $app->auth->status) {
// 			$joined = $app->usershift
// 				->create([
// 					'shift_id' => $id,
// 					'user_id' => $app->auth->username,
// 					'user_email' =>$app->auth->email
// 				]);
// 			$app->shift->where('id', $id)->update([
// 		'count' => $test
// 	]);
// 			echo json_encode("Signed Up");
// 			// $app->flash('global','signed up');
// 			// $app->redirect($app->urlFor('shifts'));
// 		}
// 		else {
// 			echo json_encode("Insufficient Permissions. You cannot sign up for this shift");
// 			// $app->flashNow('global','Insufficient Permissions. You cannot sign up for this shift');
// 			// $app->redirect($app->urlFor('shifts'));
// 		}
// 	}
// 	elseif($app->auth->status >= 4) {
// 			$joined = $app->usershift
// 				->create([
// 					'shift_id' => $id,
// 					'user_id' => $app->auth->username,
// 					'user_email' =>$app->auth->email
// 				]);
// 			$app->shift->where('id', $id)->update([
// 		'count' => $test
// 	]);
// 			echo json_encode("Signed Up");
// 			// $app->flash('global','signed up');
// 			// $app->redirect($app->urlFor('shifts'));
// 	}
// 	else {
// 		echo json_encode("Insufficient Permissions. You cannot sign up for this shift");
// 			// $app->flashNow('global','Insufficient Permissions. You cannot sign up for this shift');
// 			// $app->redirect($app->urlFor('shifts'));
// 	}
// 	// echo json_encode($req->post('id'));
// })->name('shifts.signup');
$app->get('/workshopleave/:id', $authenticated(), function($id) use ($app){
	$test = $app->workshop->where('id',$id)->pluck('count');
			$test = $test - 1;
	$app->workshop->where('id', $id)->update([
		'count' => $test
	]);
	$joined = $app->userworkshop
		->where('workshop_id', $id)->where('user_id',$app->auth->username)->delete();
	$app->flash('global','Left Workshop');
	$app->redirect($app->urlFor('workshops'));
})->name('workshop.leave');