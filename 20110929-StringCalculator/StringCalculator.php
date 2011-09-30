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
		if (0 === strlen($numbers)) return 0;

		$number1 = $this->getFirstNumber($numbers);
		$rest = $this->getTailForNumbers($numbers);

		return $number1 + $this->add($rest);
	}

	/**
	 * Get the first number
	 *
	 * @return void
	 */
	private function getFirstNumber($numbers) {
		$separatorPosition = strpos($numbers, self::NUMBER_SEPARATOR);

		if (false === $separatorPosition) {
			return (int) $numbers;
		}

		return (int) substr($numbers, 0, $separatorPosition);
	}

	/**
	 * Return the tail of the numbers
	 *
	 * @return void
	 */
	private function getTailForNumbers($numbers) {
		$separatorPosition = strpos($numbers, self::NUMBER_SEPARATOR);

		if (false === $separatorPosition) {
			return '';
		}

		return substr($numbers, $separatorPosition + 1);
	}

}