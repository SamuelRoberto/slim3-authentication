<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/middleware.php
 * Developed by: Samuel Roberto
 * */

$app->add(new \Slim\Middleware\Session([
    'name' => 'Slim3_Auth',
    'autorefresh' => true,
    'lifetime' => '1 hour'
]));
