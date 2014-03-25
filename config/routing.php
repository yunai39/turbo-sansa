<?php
 
// example.com/src/app.php
 
use Simplex\Routing;

 
$routes = new Routing\RouteCollection();

/*
 * Gestion Routing
 */
$routes->add('home', new Routing\Route(  'Controller\\HomeController::indexAction'));
$routes->add('admin', new Routing\Route(  'Controller\\HomeController::adminPageAction','ROLE_ADMIN'));

$routes->add('login', new Routing\Route(  'Controller\\SecurityController::loginAction'));
$routes->add('logout', new Routing\Route(  'Simplex\\Security\\Controller\\SecurityController::logoutAction'));
$routes->add('log_check', new Routing\Route(  'Simplex\\Security\\Controller\\SecurityController::logCheckAction'));

return $routes;