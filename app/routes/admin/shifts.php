<?php
$app->get('/shifts', $authenticated, function() use ($app){
	$joined = $app->shift
		->join('usershifts', 'shifts.id','=','usershifts.shift_id')
		->get();
	$users = $app->user
		->join('usershifts','users.id', '=', 'usershifts.user_id')
		->get();
	$list = $app->shift->get();
	$count = $app->shift->join('usershifts', 'shifts.id','=','usershifts.shift_id')->get()->count();
	$app->render('admin/shifts.php', [
		'count' => $count,
		'users' =>$users,
		'joined' => $joined,
		'list' => $list,
	]);

})->name('shifts');

$app->post('/shifts', $authenticated, function() use ($app){
		$request = $app->request;
		$time = $request->post('shift_time');
		$for = $request->post('for');
		$desc = $request->post('desc');
		$app->shift->create([
			'shift' => $time,
			'for' => $for,
			'desc' => $desc,
			'count' => 0
		]);
	$app->flash('global','added');
	$app->redirect($app->urlFor('shifts'));
})->name('shifts.add');

$app->get('/shiftsdelete/:id', $admin(), function($id) use ($app){
	$app->shift->where('id', $id)->delete();
	$app->flash('global','deleted');
	$app->redirect($app->urlFor('shifts'));
})->name('shifts.delete');


$app->get('/shiftssignup/:id', $authenticated(), function($id) use ($app){
	$test = $app->shift->where('id',$id)->pluck('count');
			$test = $test + 1;
	
	if($app->shift->where('id',$id)->pluck('for') != 6) {
		if($app->shift->where('id',$id)->pluck('for') == $app->auth->status) {
			$joined = $app->usershift
				->create([
					'shift_id' => $id,
					'user_id' => $app->auth->username,
					'user_email' =>$app->auth->email
				]);
			$app->shift->where('id', $id)->update([
				'count' => $test
			]);
			$app->flash('global','signed up');
			$app->redirect($app->urlFor('shifts'));
		}
		else {
			$app->flashNow('global','Insufficient Permissions. You cannot sign up for this shift');
			$app->redirect($app->urlFor('shifts'));
		}
	}
	elseif($app->auth->status >= 4) {
			$joined = $app->usershift
				->create([
					'shift_id' => $id,
					'user_id' => $app->auth->username,
					'user_email' =>$app->auth->email
				]);
			$app->shift->where('id', $id)->update([
				'count' => $test
			]);
			$app->flash('global','signed up');
			$app->redirect($app->urlFor('shifts'));
	}
	else {
		$app->flash('global','Insufficient Permissions. You cannot sign up for this shift');
			$app->redirect($app->urlFor('shifts'));
	}
})->name('shifts.signup');
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
$app->get('/shiftleave/:id', $authenticated(), function($id) use ($app){
	$test = $app->shift->where('id',$id)->pluck('count');
			$test = $test - 1;
	$app->shift->where('id', $id)->update([
		'count' => $test
	]);
	$joined = $app->usershift
		->where('shift_id', $id)->where('user_id',$app->auth->username)->delete();
	$app->flash('global','Left Shift');
	$app->redirect($app->urlFor('shifts'));
})->name('shifts.leave');