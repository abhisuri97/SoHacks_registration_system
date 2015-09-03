<?php

$app->get('/team', $authenticated(), function() use ($app){
	 if($app->auth->is_team == true) {
	 	$id = $app->auth->id;
	 $team = $app->team->where('user1', $id)
	 			->orWhere('user2',$id)
	 			->orWhere('user3',$id)
	 			->orWhere('user4',$id)
	 			->get()
	 			->first();
	 $invite = $team->invite;
	 if($team->user1 == NULL) {
		$user1=NULL;
	}
	 if($app->user->where('id',$team->user1)->get()->first()->username != NULL) 
		$user1 = $app->user->where('id',$team->user1)->get()->first();
	if($team->user2 == NULL) {
		$user2=NULL;
	}
	elseif ($app->user->where('id',$team->user2)->get()->first()->username != NULL) 
		$user2 = $app->user->where('id',$team->user2)->get()->first();
	if($team->user3 == NULL) {
		$user3=NULL;
	}
	elseif ($app->user->where('id',$team->user3)->get()->first()->username != NULL) 
		$user3 = $app->user->where('id',$team->user3)->get()->first();
	if($team->user4 == NULL) {
		$user4=NULL;
	}
	elseif ($app->user->where('id',$team->user4)->get()->first()->username != NULL) 
		$user4 = $app->user->where('id',$team->user4)->get()->first();
	 $app->render('auth/team.php', [
	 	'code' => $invite,
		'user1' => $user1,
		'user2' => $user2,
		'user3' => $user3,
		'user4' => $user4

	 ]);
	
	
	 }
	 else {
	 	$app->render('auth/team.php');
	 }	 
})->name('team');

$app->post('/team', function() use ($app){
	$id = $app->auth->id;
	$request = $app->request;
	$name = $request->post('name');

	$v = $app->validation;

	$v->validate([
		'name' => [$name, 'required|min(5)'],
	]);

	if ($app->team->where('team_name',$name)->get()->count() == 0)
	{

		$identifier = $app->randomlib->generateString(6);
		while($app->team->where('invite', $identifier)->get()->count() != 0) {
			$identifier = $app->randomlib->generateString(6);
		}
		$app->team->create([
			'invite' => $identifier,
			'user_id' => $id,
			'user1' => $id,
			'team_name' => $name,
		]);
			$app->auth->update([
					'is_team' => true
				]);	
		$app->flash('global', 'Created team ' . $name . '.');
			$app->response->redirect($app->urlFor('team'));		

	}
	else {
		$app->flash('global', 'That team name exists');
			$app->response->redirect($app->urlFor('team'));		

	}
	$app->render('auth/team.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);
})->name('team.make');

$app->post('/team/join', function() use ($app){
	$id = $app->auth->id;
	$request = $app->request;
	$invite = $request->post('invite');

	$v = $app->validation;

	$v->validate([
		'invite' => [$invite, 'required|max(6)'],
	]);

	if ($app->team->where('invite',$invite)->get()->count() == 1)
	{
			$team = $app->team->where('invite',$invite)->get()->first();
			if($team->user1 == NULL || $team->user2 == NULL || $team->user3 == NULL || $team->user4 == NULL) {

				if($team->user1 == NULL)
				$team->update([
					'user1' => $id
				]);
				elseif($team->user2 == NULL)
				$team->update([
					'user2' => $id
				]);
				elseif($team->user3 == NULL)
				$team->update([
					'user3' => $id
				]);
				elseif($team->user4 == NULL)
				$team->update([
					'user4' => $id
				]);
				$app->auth->update([
					'is_team' => true
				]);	

			$app->flash('global', 'Joined team ' . $team->team_name . '.');
			$app->response->redirect($app->urlFor('team'));	
			
			}
			else {
				$app->flash('global', 'This team is full.');
				$app->response->redirect($app->urlFor('team'));		
			}

	}
	else {
		$app->flash('global', 'This invite code does not exist');
			$app->response->redirect($app->urlFor('team'));		

	}
	$app->render('auth/team.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);
})->name('team.join');

$app->post('/team/leave', function() use ($app){
	$id = $app->auth->id;
	$request = $app->request;
	$invite = $request->post('invite');

	$v = $app->validation;

	$v->validate([
		'invite' => [$invite, 'required|max(6)'],
	]);

	if ($app->team->where('invite',$invite)->get()->count() == 1)
	{
				$team = $app->team->where('invite',$invite)->get()->first();
				if($team->user1 == $id)
					$team->update([
						'user1' => NULL
					]);
				elseif($team->user2 == $id)
					$team->update([
						'user2' => NULL
					]);
				elseif($team->user3 == $id)
					$team->update([
						'user3' => NULL
					]);
				elseif($team->user4 == $id)
					$team->update([
						'user4' => NULL
					]);
				$app->auth->update([
					'is_team' => false
				]);	
				if ($team->user1==NULL && $team->user2==NULL && $team->user3==NULL && $team->user4==NULL) {
					$app->team->where('invite',$invite)->delete();
					$app->flash('global', 'Left & deleted team.');
					return $app->response->redirect($app->urlFor('team'));	

				}
			$app->flash('global', 'Left team ' . $team->team_name . '.');
			$app->response->redirect($app->urlFor('team'));	
			
	}

	else {
		$app->flash('global', 'This invite code does not exist');
			$app->response->redirect($app->urlFor('team'));		

	}
	$app->render('auth/team.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);
})->name('team.leave');

$app->post('/team/has', function() use ($app){
	$id = $app->auth->id;
			$app->auth->update([
				'team' => true
			]);	

			$app->flash('global', 'You have marked that you have a team and will no longer be part of the team database.');
			$app->response->redirect($app->urlFor('team'));	
})->name('team.has');

$app->post('/team/addback', function() use ($app){
	$id = $app->auth->id;
			$app->auth->update([
				'team' => false
			]);	

			$app->flash('global', 'You have marked that you do not have a team and will be part of the team database.');
			$app->response->redirect($app->urlFor('team'));	
})->name('team.addback');

