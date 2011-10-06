<?php
/**
 * StringCalculator
 */
class StringCalculator
{
	const NUMBER_SEPARATOR = ',';

	/**
	 * @var string
	 */
	private $delimiter = "[\n,]";

	/**
	 * @var array
	 */
	private $negativeNumbers;



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
		$negativeNumbers = array();

		$result = $this->performAdd($numbers);

		if (count($this->negativeNumbers) > 0) {
			throw new Exception('Negative number not allowed: ' . implode(', ', $this->negativeNumbers));
		}

		return $result;
	}

	/*
	 * Perform the add
	 *
	 * @return void
	 */
	private function performAdd($numbers) {
		if (0 === strlen($numbers)) return 0;

		$numbersWithoutDelimiter = $this->extractDelimiter($numbers);

		$number1 = $this->getFirstNumber($numbersWithoutDelimiter);
		$rest = $this->getTailForNumbers($numbersWithoutDelimiter);

		return $number1 + $this->add($rest);
	}

	/**
	 * Get the first number
	 *
	 * @return void
	 */
	private function getFirstNumber($numbers) {
		$firstNumber = (int) $this->splitString($numbers, 0);

		if ($firstNumber < 0) $this->negativeNumbers[] = $firstNumber;

		return $firstNumber;
	}

	/**
	 * Return the tail of the numbers
	 *
	 * @return void
	 */
	private function getTailForNumbers($numbers) {
		return $this->splitString($numbers, 1);
	}

	/**
	 * Split the string and return the wanted part
	 *
	 * @return void
	 */
	private function splitString($numbers, $partToReturn) {
		$parts = preg_split("/{$this->delimiter}/", $numbers, 2, PREG_SPLIT_NO_EMPTY);

		if (array_key_exists($partToReturn, $parts)) return $parts[$partToReturn];

		return '';
	}

	/**
	 * Extract the delimiter if there is one
	 *
	 * @return void
	 */
	private function extractDelimiter($numbers) {
		if (0 === strpos($numbers, '//')) {
			$returnPos = strpos($numbers, "\n");
			$delimiter = substr($numbers, 2, $returnPos - 2);

			$this->delimiter = $delimiter;

			return substr($numbers, $returnPos + 1);
		}

		return $numbers;
	}

}