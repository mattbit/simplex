<?php namespace Simplex\Tests;

use Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{
	public function testNotFoundHandling()
	{
		$framework = $this->getFrameworkForException(new ResourceNotFoundException());
		$response = $framework->handle(new Request());

		$this->assertEquals(404, $response->getStatusCode()); 
	}

	public function testErrorHandling()
	{
		$framework = $this->getFrameworkForException(new \RuntimeException());
		$response = $framework->handle(new Request());

		$this->assertEquals(500, $response->getStatusCode()); 
	}

	public function testControllerResponse()
	{
		$matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
		$matcher
			->expects($this->once())
			->method('match')
			->will($this->returnValue(array(
					'_route' => 'test_route',
					'parameter' => 'test_parameter',
					'_controller' => function ($parameter) {
						return new Response("Parameter is ".$parameter);
					}
				)))
		;

		$resolver = new ControllerResolver();
		$framework = new Framework($matcher, $resolver);

		$response = $framework->handle(new Request());

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertContains('Parameter is test_parameter', $response->getContent());
	}

	public function getFrameworkForException($exception)
	{
		$matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
		$matcher
			->expects($this->once())
			->method('match')
			->will($this->throwException($exception))
		;
		$resolver = $this->getMock('Symfony\Component\HttpKernel\Controller\ControllerResolverInterface');

		return new Framework($matcher, $resolver);
	}
}