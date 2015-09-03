<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

use sohacks\User\User;
use sohacks\User\UserPermission;
use sohacks\User\Team;
use sohacks\User\Shift;
use sohacks\User\Usershift;
use sohacks\User\Workshop;
use sohacks\User\Userworkshop;
use sohacks\Mail\Mailer;
use sohacks\Sign\Signer;
use sohacks\Text\Texter;
use sohacks\Helpers\Hash;
use sohacks\Validation\Validator;
use sohacks\Middleware\BeforeMiddleware;
use sohacks\Middleware\CsrfMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
	'mode' => file_get_contents(INC_ROOT . '/mode.php'),
	'view' => new Twig(),
	'templates.path' => INC_ROOT . '/app/views'
]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);


$app->configureMode($app->config('mode'),function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function() {
	return new User;
});
$app->container->set('team', function() {
	return new Team;
});
$app->container->set('shift', function() {
	return new Shift;
});
$app->container->set('workshop', function() {
	return new Workshop;
});
$app->container->set('userworkshop', function() {
	return new Userworkshop;
});
$app->container->set('usershift', function() {
	return new Usershift;
});
$app->container->singleton('hash', function() use ($app) {
	return new Hash($app->config);
});

$app->container->singleton('validation', function() use ($app) {
	return new Validator($app->user, $app->hash, $app->auth);
});
$app->container->singleton('mail', function() use ($app) {
	$user = $app->config->get('mail.username');
	$pass =  $app->config->get('mail.password');
	$from = $app->config->get('mail.from');
	$sendgrid = new SendGrid($user,$pass);
	$email = new SendGrid\Email();
	return new Mailer($app->view, $email, $sendgrid, $from);
});

$app->container->singleton('sign', function() use ($app) {
	$hellosign = $app->config->get('sign.api');
	$templateid =  $app->config->get('sign.template');
	$client = new HelloSign\Client($hellosign);
	$request = new HelloSign\TemplateSignatureRequest;
	return new Signer($app->auth, $client, $request, $templateid,$app->user);
});
$app->container->singleton('text', function() use ($app) {
	$sid="ACf1e7f3d8d9aa747f7c53258e3700b614";
	$token="d545a2dbf26c8a8d8a8355c76b0ab720";
	$client = new Services_Twilio($sid,$token);
	return new Texter($app->view, $client, $app->user);
});
$app->container->singleton('randomlib', function() {
	$factory = new RandomLib;
	return $factory->getMediumStrengthGenerator();
});

$view = $app->view();

$view->parserOptions = [
	'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
	new TwigExtension
];

