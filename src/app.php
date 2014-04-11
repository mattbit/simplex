<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', array('_controller' => 'render_template', 'name' => 'World')));
$routes->add('bye', new Route('/bye/{name}'));


$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
		'year' => null,
		'_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));

return $routes;