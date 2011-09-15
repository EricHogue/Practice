<?php
/**
 * Factorial
 */
class Factorial
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Compute the factorial of a number
	 *
	 * @return void
	 */
	public function computeFactorial($value) {
		if ($value < 1) return 1;
		else {
			$function = function ($initial, $newValue) {
				return $initial * $newValue;
			};
			return array_reduce(range(1, $value), $function, 1);
		}
	}

}