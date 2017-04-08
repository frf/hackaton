<?php

use Respect\Validation\Validator;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' 	=> [
		'displayErrorDetails' => true,
	    // 'determineRouteBeforeAppMiddleware' => true,
	    'addContentLengthHeader' => false,
    		'db' => [
			'driver' 	=> 'mysql',
			'host'		=> 'localhost',
			'database'	=> 'thinkific',
			'username'		=> 'root',
			'password'	=> 'root',
			'charset'	=> 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'	=> '',
		]
	]
]);

$container 	= $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use($capsule){
	return $capsule;
};

$container['authentication'] = function ($container) {
	return new \Thinkific\Authentication\Authentication;
};

$container['flash'] = function ($container) {
	return new \Slim\Flash\Messages;
};

$container['view'] = function ($container){

	$view = new \Slim\Views\Twig( __DIR__ . '/../src/Views', [
		'cache' => false,
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	// unset($_SESSION['user_id']);

	$view->getEnvironment()->addGlobal('authentication', [
		'check'	=> $container->authentication->check(),
		'user' 	=> $container->authentication->getUser(),
	]);

	$view->getEnvironment()->addGlobal('settings', [
		'logo'	=> '/assets/images/thinkific-logo.png',
		'logo2x'	=> '/assets/images/thinkific-logo@2x.png',
	]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['HomeController'] = function ($container) {
    return new \Thinkific\Controllers\HomeController($container);
};

$container['ApiUser'] = function ($container) {
    return new \Thinkific\Controllers\Api\User($container);
};

$container['AuthenticationController'] = function ($container) {
	return new \Thinkific\Controllers\Authentication\AuthenticationController($container);
};

$container['PasswordController'] = function ($container) {
	return new \Thinkific\Controllers\Authentication\PasswordController($container);
};

$container['validator'] = function ($container){
	return new Thinkific\Validation\Validator;
};

$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};

$app->add(new \Thinkific\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \Thinkific\Middleware\OldInputMiddleware($container));
$app->add(new \Thinkific\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

Validator::with('Thinkific\\Validation\\Rules\\');

require __DIR__ . '/../src/route.php';
