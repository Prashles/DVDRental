<?php

use Dotenv\Dotenv;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use \FastRoute\RouteCollector;

/*
 * Define application paths
 */

define('BASE_PATH', __DIR__ . '/');
define('APP_PATH', BASE_PATH . 'App/');
define('PUBLIC_PATH', BASE_PATH . 'public/');

/*
 * Autoloader
 */
require_once BASE_PATH . 'vendor/autoload.php';

/*
 * Environment variables
 */
$dotenv = new Dotenv(BASE_PATH);
$dotenv->load();


/*
 * Request
 */
$request = Request::createFromGlobals();

/*
 * Create the router
 */

// Define the routes
$defineRoutes = function (RouteCollector $r) {
    $routes = require APP_PATH . 'routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

// Dispatch
$dispatcher = simpleDispatcher($defineRoutes);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getRequestUri());

// Response based on route match
if ($routeInfo[0] == Dispatcher::NOT_FOUND) {
    // 404
    die('404');
    // TODO: make status code error
}
elseif ($routeInfo[0] == Dispatcher::METHOD_NOT_ALLOWED) {
    // 405
    die('405');
}
elseif ($routeInfo[0] == Dispatcher::FOUND) {
    // Route found, call appropriate constructor
    $className = $routeInfo[1][0];
    $method = $routeInfo[1][1];
    $vars = $routeInfo[2];

    if (!is_callable([$className, $method])) {
        // 404, log error
        die('Class not found');
    }
    else {
        $controller = new $className;
        $controller->$method($vars);
    }
}