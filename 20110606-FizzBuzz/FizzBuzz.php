<?php
/**
 * ClassDescription
 */
class FizzBuzz
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Say
	 *
	 * @return void
	 */
	public function say($number) {
		if (0 === ($number % 3) && 0 === ($number % 5)) return 'FizzBuzz';
		if (0 === ($number % 3)) return 'Fizz';
		if (0 === ($number % 5)) return 'Buzz';
		return $number;
	}

}