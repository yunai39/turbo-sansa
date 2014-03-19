<?php
 
// example.com/src/app.php
 
use Simplex\Routing;

 
$routes = new Routing\RouteCollection();

/*
 * Gestion Routing
 */
$routes->add('home', new Routing\Route(  'Controller\\HomeController::indexAction'));



return $routes;