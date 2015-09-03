<?php

$app->get('/account/profile', $authenticated(), function() use ($app) {
	$app->render('account/profile.php');
})->name('account.profile');

$app->post('/account/profile', $authenticated(), function() use ($app) {

	$request = $app->request;
	$save = $request->post('save');
	$submit = $request->post('submit');
	$email = $request->post('email');
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');
	$gender = $request->post('gender');
	$address = $request->post('address');
	$city = $request->post('city');
	$state = $request->post('state');
	$zip = $request->post('zip');
	$school = $request->post('school');
	$age = $request->post('age');
	$grade = $request->post('grade');
	$tshirt = $request->post('tshirt');
	$state = $request->post('state');
	$sohacks = $request->post('sohacks');
	$hack = $request->post('hack');
	$prog = $request->post('prog');
	$lang1 = $request->post('lang1');
	$lang2 = $request->post('lang2');
	$lang3 = $request->post('lang3');
	$proj = $request->post('proj');
	$team = $request->post('team');
	$travel = $request->post('travel');
	$phone = $request->post('phone');
	$allergies = $request->post('allergies');
	$race = $request->post('race');
	$langs = $request->post('langs');
	$laptop = $request->post('laptop');
	$v = $app->validation;
	$v->validate([
		'email' => [$email, 'required|email|uniqueEmail'],
		'first_name' => [$firstName, 'alpha|max(50)'],
		'last_name' => [$lastName, 'alpha|max(50)'],
		'state' => [$state, 'alnum|max(3)'],
		'zip' => [$zip, 'alnum|max(5)'],
		'age' => [$age, 'alnum|max(2)'],

	]);

	if($v->passes()) {
		$app->auth->update([
			'email' => $email,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'gender' => $gender,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip,
			'school' => $school,
			'age' => $age,
			'grade' => $grade,
			'tshirt' => $tshirt,
			'state' => $state,
			'sohacks' => $sohacks,
			'hack' => $hack,
			'prog' => $prog,
			'lang1' => $lang1,
			'lang2' => $lang2,
			'lang3' => $lang3,
			'proj' => $proj,
			'team' => $team,
			'travel' => $travel,
			'phone' => $phone,
			'allergies' => $allergies,
			'race' => $race,
			'langs' => $langs,
			'laptop'=> $laptop
		]);

	if($submit) {

		$app->auth->update([
			'is_submitted' => true
		]);
		$app->flash('global', 'Your Application has been submitted.');
	}
	if($save) {
		$app->flash('global', 'Your Information has been updated.');
	}
		$app->response->redirect($app->urlFor('account.profile'));

	}
	$app->render('account/profile.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);
})->name('account.profile.post');