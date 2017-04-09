<?php

use Thinkific\Middleware\AuthenticationMiddleware;
use Thinkific\Middleware\GuestMiddleware;
use Thinkific\Controllers\Api\User;

$app->get('/{id}/courses/emb', 'Course:embedded');

$app->group('/rest', function () use ($app){
    $app->get('/users/{id}', 'ApiUser:getUser');
    $app->get('/email/new', 'ApiEmail:new');
    $app->get('/{id}/courses/embedded', 'ApiCourse:loadEmbedded');
});


$app->group('', function() use ($app) {
	$app->get( '/authentication/signup', 'AuthenticationController:getSignUp' )->setName('authentication.signup');
	$app->post('/authentication/signup', 'AuthenticationController:postSignUp');

	$app->get( '/authentication/signin', 'AuthenticationController:getSignIn' )->setName('authentication.signin');
	$app->post('/authentication/signin', 'AuthenticationController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('', function() use ($app){
    $app->get( '/', 'HomeController:index')->setName('home');

    $app->get( '/authentication/password/change', 'PasswordController:getChangePassword' )->setName('authentication.password.change');
	$app->post('/authentication/password/change', 'PasswordController:postChangePassword');

	$app->get( '/authentication/signout', 'AuthenticationController:getSignOut' )->setName('authentication.signout');

    $app->get('/courses/new',  'Course:new');
    $app->get('/{id}/courses', 'Course:view');

})->add(new AuthenticationMiddleware($container));

