<?php

use Core\Session;
use Core\ValidationException;


session_start();


const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

// Autoload classes
spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');


$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    // Redirect to the previous URL
    return redirect($router->previousUrl());
}

// Clear flashed session data
Session::unflash();



