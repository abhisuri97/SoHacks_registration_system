<?php

$app->get('/team/all', $authenticated(), function() use ($app) {
	$username = $app->auth->username;
	$users = $app->user
		->join('users_permissions', 'users.id','=','users_permissions.user_id')
		->where('team', false)
		->orWhereNull('team')
		->where('is_admin',false)
		->where('is_attending',true)
		->where('role',"attendee")
		->where('username','!=', $username)
		->get();
	$looking = $users->count();
	$app->render('/user/all.php', [
		'users' => $users,
		'looking' => $looking
	]);
	
})->name('team.all');

// $app->get('/admit/:userId', $admin(), function($userId) use ($app) {
// 	$user = $app->user->where('id',$userId)->first();
// 	$user->update([
// 		'status' => 2,
// 	]);
// 	$app->flash('global', 'Accepted ' . $user->username . '.');
// 	$app->response->redirect($app->urlFor('admin.admit'));
// })->name('admit');

// $app->get('/deny/:userId', $admin(), function($userId) use ($app) {
// 	$user = $app->user->where('id',$userId)->first();
// 	$user->update([
// 		'status' => 1,
// 	]);
// 		$app->flash('global', 'Denied ' . $user->username . '.');
// 	$app->response->redirect($app->urlFor('admin.admit'));	
// })->name('deny');

// $app->get('/admitted', $admin(), function() use ($app) {
// 	$users2 = $app->user->where('status',2)->get();
// 	$accept = $app->user->where('status', 2)->get()->count();
// 	$reject = $app->user->where('status', 1)->get()->count();
// 	$applied = $app->user->where('is_submitted', true)->get()->count();
// 	$left = $app->user->where('status', NULL)->where('is_submitted',true)->get()->count();

// 	$app->render('/admin/attendees/admitAttendees.php' , [
// 		'users' => $users2,
// 		'accept' => $accept,
// 		'reject' => $reject,
// 		'applied' => $applied,
// 		'left' => $left
// 	]);

// })->name('admitted');
// $app->get('/denied', $admin(), function() use ($app) {
// 	$users3 = $app->user->where('status',1)->get();
// 	$accept = $app->user->where('status', 2)->get()->count();
// 	$reject = $app->user->where('status', 1)->get()->count();
// 	$applied = $app->user->where('is_submitted', true)->get()->count();
// 	$left = $app->user->where('status', NULL)->where('is_submitted',true)->get()->count();
// 	$app->render('/admin/attendees/admitAttendees.php' , [
// 		'users' => $users3,
// 		'accept' => $accept,
// 		'reject' => $reject,
// 		'applied' => $applied,
// 		'left' => $left
// 	]);

// })->name('denied');
