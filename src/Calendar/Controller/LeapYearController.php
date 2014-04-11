<?php namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

class LeapYearController
{
	public function indexAction($year)
	{
		$leapyear = new LeapYear();

		if ($leapyear->isLeap($year)) {
			return new Response('Yes, it is a leap year.');
		}

		return new Response('No, it is not a leap year.');
	}
}