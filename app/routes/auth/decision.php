<?php
$app->get('/auth/decision', $authenticated(), function() use ($app){

	 $app->render('auth/decision.php');

})->name('decision');
$app->get('/auth/decision/confirm', $authenticated(), function() use ($app) {
	$app->auth->update([
		'is_attending' => true
	]);
	$app->flash('global', 'You have confirmed your attendance.');
	$app->response->redirect($app->urlFor('decision'));	
	

})->name('decision.confirm');

$app->get('/auth/decision/deny', $authenticated(), function() use ($app) {
	$app->auth->update([
		'is_attending' => false
	]);
	$app->flash('global', 'You have denied your attendance. We hope to see you next year.');
	$app->response->redirect($app->urlFor('decision'));	
	

})->name('decision.deny');