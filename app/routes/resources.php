<?php

$app->get('/resources', function() use ($app) {
	$app->render('resources.php');
})->name('resources');