<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/routes.php
 * Developed by: Samuel Roberto
 * */

$app->get('/', App\Action\HomeAction::class);

$app->get('/login/[{option}]', App\Action\LoginAction::class);
$app->post('/login', App\Action\LoginAction::class .':loginPost');

$app->get('/register/[{option}]', App\Action\RegisterAction::class);
$app->post('/register', App\Action\RegisterAction::class . ':registerPost');

$app->get('/logout', App\Action\LogoutAction::class);

// USER Group: Login Required
$app->group('/user', function () use ($app) {
    $app->get('/profile', App\Action\User\ProfileAction::class);
})->add(App\Middleware\AuthMiddleware::class);