<?php namespace Simplex\Event;

use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
	protected $request;
	protected $response;

	public function __construct($response, $request)
	{
		$this->response = $response;
		$this->request = $request;
	}

	public function getRequest()
	{
		return $this->request;
	}

	public function getResponse()
	{
		return $this->response;
	}
}