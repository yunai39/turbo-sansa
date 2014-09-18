<?php 
use Simplex\Twig\TwigUrlGenerator;
use Simplex\Twig\TwigConnected;
use Simplex\Twig\TwigAsset;

$loader = new Twig_Loader_Filesystem('../src/View');
$twig = new Twig_Environment($loader, array(
  // For now no cache as this is too annoying for devellopement
//  'cache' => '../cache/',
));
$twig->addGlobal('session', $session);
$twig->addExtension(new  TwigConnected($session));
$twig->addExtension(new  TwigUrlGenerator($generator));
$twig->addExtension(new TwigAsset());