<?php

use Thinkific\Middleware\AuthenticationMiddleware;
use Thinkific\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home'); 


$app->group('', function() use ($app) {
	$app->get( '/authentication/signup', 'AuthenticationController:getSignUp' )->setName('authentication.signup'); 
	$app->post('/authentication/signup', 'AuthenticationController:postSignUp'); 

	$app->get( '/authentication/signin', 'AuthenticationController:getSignIn' )->setName('authentication.signin'); 
	$app->post('/authentication/signin', 'AuthenticationController:postSignIn'); 

})->add(new GuestMiddleware($container));

$app->group('', function() use ($app){

	$app->get( '/authentication/password/change', 'PasswordController:getChangePassword' )->setName('authentication.password.change'); 
	$app->post('/authentication/password/change', 'PasswordController:postChangePassword'); 

	$app->get( '/authentication/signout', 'AuthenticationController:getSignOut' )->setName('authentication.signout'); 
})->add(new AuthenticationMiddleware($container));

