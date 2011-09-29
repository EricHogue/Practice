<?php
/**
 * StringCalculator
 */
class StringCalculator
{
	const NUMBER_SEPARATOR = ',';

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Add numbers from a string
	 *
	 * @return integer
	 */
	public function add($numbers) {
		$separatorPosition = strpos($numbers, self::NUMBER_SEPARATOR);
		if (false === $separatorPosition) {
			return (int) $numbers;
		} else {
			$number1 = substr($numbers, 0, $separatorPosition);
			$number2 = substr($numbers, $separatorPosition + 1);

			return $number1 + $number2;
		}
	}

}