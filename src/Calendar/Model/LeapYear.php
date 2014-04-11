<?php namespace Calendar\Model;

class LeapYear
{
	/**
	* Determine if a given year is leap or not.
	* @return boolean
	*/
	public function isLeap($year) {
		$year = $year ?: date('Y');
		return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
	}	
}