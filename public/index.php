<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeduliRasa\App\Router;
use PeduliRasa\Config\Database;
use PeduliRasa\Controller\HomeController;
use PeduliRasa\Controller\UserController;
use PeduliRasa\Middleware\MustNotLoginMiddleware;
use PeduliRasa\Middleware\MustLoginMiddleware;

//database
Database::getConnection('prod');

//set timezone
date_default_timezone_set("Asia/jakarta");

//set session for flasher message
if(!session_id()) session_start();

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
Router::add("GET","/ayo-berbagi", HomeController::class,"post",[MustNotLoginMiddleware::class]);
Router::add("POST","/ayo-berbagi", HomeController::class,"postUpload",[MustNotLoginMiddleware::class]);
Router::add("GET","/post/detail/([0-9]*)", HomeController::class,"detail",[MustNotLoginMiddleware::class]);
Router::add("POST","/post/detele", HomeController::class,"postDelete",[MustNotLoginMiddleware::class]);

// User Controller
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/users/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/users/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/users/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

Router::run();