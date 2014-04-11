<?php

use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
	public function indexAction($year)
	{
		if ($this->is_leap_year($year)) {
			return new Response('Yes, it is a leap year.');
		}

		return new Response('No, it is not a leap year.');
	}
	
	/**
	* Determine if a given year is leap or not.
	* @return boolean
	*/
	protected function is_leap_year($year) {
		$year = $year ?: date('Y');
		return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
	}
}

// function render_template($request)
// {
//     extract($request->attributes->all(), EXTR_SKIP);
//     ob_start();
//     include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
 
//     return new Response(ob_get_clean());
// }