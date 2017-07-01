<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/settings.php
 * Developed by: Samuel Roberto
 * */

require_once(__DIR__ . '/config.php');
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => DISPLAY_ERRORS,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],

        // Database settings
        'db' => [
            'host' => DB_HOST,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'dbname' => DB_NAME
        ]
    ],
];
