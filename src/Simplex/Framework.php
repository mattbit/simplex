<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;


class Framework
{
	protected $matcher;
	protected $resolver;
}
$request = Request::createFromGlobals();
$response = new Response();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$resolver = new HttpKernel\Controller\ControllerResolver();

try {
	$request->attributes->add($matcher->match($request->getPathInfo()));

	$controller = $resolver->getController($request);
	$arguments = $resolver->getArguments($request, $controller);

	$response = call_user_func_array($controller, $arguments);
}
catch (Routing\Exception\ResourceNotFoundException $e) {
	$response->setContent('Not found.');
	$response->setStatusCode(404);
}
catch (Exception $e) {
	$response->setContent('An error occurred.');
	$response->setStatusCode(500);
}

$response->prepare($request);
$response->send();