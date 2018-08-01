<?php
    
    require_once '../config.php';
    require_once '../vendor/autoload.php';
    
    /**
     * Settings for Slim RESTFul application.
     * @var array $config
     */
    $config = [
        'settings' => [
            'displayErrorDetails' => false // set to false in production.
        ],
    ];
    
    /**
     * New instance of Slim RESTFul application.
     * @var \Slim\App $app
     */
    $app = new \Slim\App($config);
    
    /**
     * Register routes.
     */
    require_once SITE_ROOT . '/Module/Quiz/Controller/Routes.php';
    
    /**
     * Run Slim RESTFul application.
     */
    $app->run();
