<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher;
use Simplex\Event\ResponseEvent;

$request = Request::createFromGlobals();
$response = new Response();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);

$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();
$dispatcher = new EventDispatcher\EventDispatcher();

$framework = new Simplex\Framework($matcher, $resolver, $dispatcher);

$response = $framework->handle($request);

$response->prepare($request);
$response->send();