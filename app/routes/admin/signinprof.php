<?php
use Carbon\Carbon;

$app->get('/s/:username' , function($username) use ($app) {
	$user = $app->user->where('username',$username)->first();
	if(!$user) {
		$app->notFound();
	}
	$app->render('admin/signinprof.php', [
		'user' => $user
	]);
})->name('signin.prof');

$app->post('/s/:username', function($username) use ($app) {

	$request = $app->request;
	$signin = $request->post('signin');
	$signout = $request->post('signout');
	$email = $request->post('email');
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');
	$email = $request->post('email');
	$phone = $request->post('phone');
	$allergies = $request->post('allergies');
	$laptop = $request->post('laptop');
	$eventphone = $request->post('eventphone');
	if($app->user->where('username',$username)->pluck('role') == "attendee") {
		$status = 2;
	}
	if($app->user->where('username',$username)->pluck('role') == "volunteer") {
		$status = 4;
	}
	if($app->user->where('username',$username)->pluck('role') == "mentor") {
		$status = 5;
	}

	if($signin) {
		$current = $app->user->where('username',$username)->pluck('times');
		$mytime = Carbon::now();
		$mytime = $mytime->toDateTimeString();
		$newtime = $current.'_____'.$mytime;
		$app->user->where('username',$username)->update([
			'first_name' => $firstName,
			'last_name' => $lastName,
			'email' => $email,
			'phone' => $phone,
			'eventphone' => $eventphone,
			'allergies' => $allergies,
			'laptop'=> $laptop,
			'is_here' => true,
			'times' => $newtime,
			'is_notified' => true,
			'is_attending' => true,
			'status' => $status,
			'is_submitted' => true
		]);
		$app->flash('global', 'User Signed In.');
	}
	if($signout) {
		$current = $app->user->where('username',$username)->pluck('times');
		$mytime = Carbon::now();
		$mytime = $mytime->toDateTimeString();
		$newtime = $current.'_____'.$mytime;
		$app->user->where('username',$username)->update([
			'is_here' => false,
			'times' => $newtime
		]);
		$app->flash('global', 'Logged Out');
		}
		$app->response->redirect($app->urlFor('signin'));

	
	
})->name('signinprof.post');

// $app->post('/profile/:id' , function($id) use ($app) {
// 	$user = $app->user->where('id',$id)->first();
// 	if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
//   $filename = basename($_FILES['uploaded_file']['name']);

//   $ext = substr($filename, strrpos($filename, '.') + 1);
//   if ((($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") && 
//     ($_FILES["uploaded_file"]["size"] < 5242880)) || (($ext == "png") && ($_FILES["uploaded_file"]["type"] == "image/png") && 
//     ($_FILES["uploaded_file"]["size"] < 5242880))) {
//     //Determine the path to which we want to save this file

//       $currentdir = getcwd();
//       $newname = $currentdir.'/uploads/'.md5($filename) . '_' . time() . '.' . $ext;
//       $file2 = md5($filename). '_' .time() .'.' . $ext;
//       if($app->auth->profpic!=NULL) {
//       	$prevFile = $app->auth->profpic;
//       	if(file_exists($currentdir.'/uploads/'.$prevFile)) {
//       		unlink($currentdir.'/uploads/'.$prevFile);
//       	}
//       }
//       if (!file_exists($newname)) {
//         if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
// 				$app->auth->update([
// 					'profpic' => $file2
// 				]);
// 				$app->flash('global', 'Image Upload Successful');
// 				$app->response->redirect($app->urlFor('user.profile', [
// 					'username' => $app->auth->username
// 				]));        
// 			} else {
//           		$app->flash('global', 'error');
// 				$app->response->redirect($app->urlFor('user.profile', [
// 					'username' => $app->auth->username
// 				]));
//         }
//       } else {
//          $app->flash('global', 'Error. This filename exists');
// 				$app->response->redirect($app->urlFor('user.profile', [
// 					'username' => $app->auth->username
// 				]));
//       }
//   } else {
//      $app->flash('global', 'Error. Only jpg and png under 5 MB allowed');
// 				$app->response->redirect($app->urlFor('user.profile', [
// 					'username' => $app->auth->username
// 				]));
// 			}
// } else {
//  $app->flash('global', 'Error, no file uploaded');
// 				$app->response->redirect($app->urlFor('user.profile', [
// 					'username' => $app->auth->username
// 				]));
// }

// })->name('user.picupload');




