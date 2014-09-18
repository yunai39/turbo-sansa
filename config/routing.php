<?php
 
// example.com/src/app.php
 
use Simplex\Routing;

 
$routes = new Routing\RouteCollection();

/*
 * Gestion Routing
 */
$routes->add('home', new Routing\Route(  'Controller\\HomeController::indexAction'));
$routes->add('formTest', new Routing\Route(  'Controller\\HomeController::formTestAction'));
$routes->add('admin', new Routing\Route(  'Controller\\AdminController::adminPageAction'));
$routes->add('addUser', new Routing\Route(  'Controller\\AdminController::addUserFormAction'));
$routes->add('addPicture', new Routing\Route(  'Controller\\AdminController::addPictureFormAction'));

$routes->add('login', new Routing\Route(  'Controller\\SecurityController::loginAction'));
$routes->add('logout', new Routing\Route(  'Simplex\\Security\\Controller\\SecurityController::logoutAction'));
$routes->add('log_check', new Routing\Route(  'Simplex\\Security\\Controller\\SecurityController::logCheckAction'));

return $routes;