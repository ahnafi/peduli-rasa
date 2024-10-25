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
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/tentang-kami', HomeController::class, 'about');
Router::add("GET","/ayo-berbagi", HomeController::class,"upload",[MustLoginMiddleware::class]);
Router::add("POST","/ayo-berbagi", HomeController::class,"postUpload",[MustLoginMiddleware::class]);
Router::add("GET","/post/detail/([0-9]*)", HomeController::class,"detail");
Router::add("GET","/post/search", HomeController::class,"search");
Router::add("POST","/post/delete", HomeController::class,"postDelete",[MustLoginMiddleware::class]);
Router::add("GET","/post/update/([0-9]*)", HomeController::class,"update",[MustLoginMiddleware::class]);
Router::add("POST","/post/update", HomeController::class,"postUpdate",[MustLoginMiddleware::class]);

// User Controller
Router::add('GET', '/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

Router::run();