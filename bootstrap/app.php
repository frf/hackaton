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
			'database'	=> 'ovpn_manager',
			'username'		=> 'root',
			'password'	=> 'r00t',
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
	return new \OpenVpnManager\Authentication\Authentication;
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
		'logo'	=> '/assets/images/supervisor_logo.png',
	]);

	$view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['HomeController'] = function ($container) {
	return new \OpenVpnManager\Controllers\HomeController($container);
};

$container['AuthenticationController'] = function ($container) {
	return new \OpenVpnManager\Controllers\Authentication\AuthenticationController($container);
};

$container['PasswordController'] = function ($container) {
	return new \OpenVpnManager\Controllers\Authentication\PasswordController($container);
};

$container['validator'] = function ($container){
	return new OpenVpnManager\Validation\Validator;
};

$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};

$app->add(new \OpenVpnManager\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \OpenVpnManager\Middleware\OldInputMiddleware($container));
$app->add(new \OpenVpnManager\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

Validator::with('OpenVpnManager\\Validation\\Rules\\');

require __DIR__ . '/../src/route.php';

