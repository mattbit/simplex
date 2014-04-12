<?php namespace Calendar\Tests;

use Calendar\Model\LeapYear;

class LeapYearTest extends \PHPUnit_Framework_TestCase
{

	/**
	* Badly written test
	*/
	public function testIsLeap()
	{
		$leapyear = new LeapYear();

		$leaps = array(1896, 1996, 2000, 2012);
		$not_leaps = array(1800, 1900, 2001, 2011);

		foreach($leaps as $leap) {
			$this->assertTrue($leapyear->isLeap($leap));
		}
		
		foreach($not_leaps as $not_leap) {
			$this->assertFalse($leapyear->isLeap($not_leap));
		}
	}
}