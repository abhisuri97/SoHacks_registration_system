<?php

$app->get('/', function() use ($app) {
	$attendee_total = $app->user->where('role', 'attendee')->count();
	$attendee_finished = $app->user->where('role', 'attendee')->where('is_submitted', true)->count();
	$attendee_accept = $app->user->where('role', 'attendee')->where('status', '2')->count();
	$attendee_deny = $app->user->where('role', 'attendee')->where('status', '1')->count();
	$attendee_attend_confirm = $app->user->where('role', 'attendee')->where('is_attending', true)->count();
	$attendee_attend_deny = $app->user->where('role', 'attendee')->where('is_attending', false)->count();
	$attendee_signed = $app->user->where('role', 'attendee')->where('is_signed', true)->count();

	$mentor_total = $app->user->where('role', 'mentor')->count();
	$mentor_finished = $app->user->where('role', 'mentor')->where('is_submitted', true)->count();
	$mentor_accept = $app->user->where('role', 'mentor')->where('status', '5')->count();
	$mentor_deny = $app->user->where('role', 'mentor')->where('status', '1')->count();
	$mentor_attend_confirm = $app->user->where('role', 'mentor')->where('is_attending', true)->count();
	$mentor_attend_deny = $app->user->where('role', 'mentor')->where('is_attending', false)->count();
	$mentor_signed = $app->user->where('role', 'mentor')->where('is_signed', true)->count();

	$volunteer_total = $app->user->where('role', 'volunteer')->count();
	$volunteer_finished = $app->user->where('role', 'volunteer')->where('is_submitted', true)->count();
	$volunteer_accept = $app->user->where('role', 'volunteer')->where('status', '4')->count();
	$volunteer_deny = $app->user->where('role', 'volunteer')->where('status', '1')->count();
	$volunteer_attend_confirm = $app->user->where('role', 'volunteer')->where('is_attending', true)->count();
	$volunteer_attend_deny = $app->user->where('role', 'volunteer')->where('is_attending', false)->count();
	$volunteer_signed = $app->user->where('role', 'volunteer')->where('is_signed', true)->count();

	$app->render('home.php', [
		'attendee_total' => $attendee_total,
		'attendee_finished' => $attendee_finished,
		'attendee_accept' => $attendee_accept,
		'attendee_deny' =>  $attendee_deny,
		'attendee_attend_confirm' => $attendee_attend_confirm,
		'attendee_attend_deny' => $attendee_attend_deny,
		'attendee_signed' => $attendee_signed,

		'mentor_total' => $mentor_total,
		'mentor_finished' => $mentor_finished,
		'mentor_accept' => $mentor_accept,
		'mentor_deny' =>  $mentor_deny,
		'mentor_attend_confirm' => $mentor_attend_confirm,
		'mentor_attend_deny' => $mentor_attend_deny,
		'mentor_signed' => $mentor_signed,

		'volunteer_total' => $volunteer_total,
		'volunteer_finished' => $volunteer_finished,
		'volunteer_accept' => $volunteer_accept,
		'volunteer_deny' =>  $volunteer_deny,
		'volunteer_attend_confirm' => $volunteer_attend_confirm,
		'volunteer_attend_deny' => $volunteer_attend_deny,
		'volunteer_signed' => $volunteer_signed,
	]);
})->name('home');