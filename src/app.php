<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

$routes = new RouteCollection();

$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
		'year' => null,
		'_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));

return $routes;