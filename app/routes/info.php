<?php

$app->get('/info', function() use ($app) {
	$app->render('info.php');
})->name('info');