<?php
 
// example.com/web/front.php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Simplex\Twig\TwigUrlGenerator;
use Simplex\Twig\TwigConnected;
use Simplex\Twig\TwigAsset;
use Simplex\Routing;
use Simplex\Session;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../config/routing.php';

$matcher = new Routing\UrlMatcher($routes);
$resolver = new HttpKernel\Controller\ControllerResolver();
$generator = new Routing\UrlGenerator($routes);
$session = new Session();


//Ajout des twig
include('../config/twigExt.php');
include('../config/config.php');
$framework = new Simplex\Framework($matcher, $resolver, $generator,$twig,$session,$config);
$response = $framework->handle($request);
$response->send();