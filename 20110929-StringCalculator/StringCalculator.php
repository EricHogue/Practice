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
	private $delimiters = array(',', "\n");

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

		$numbersWithoutDelimiter = $this->extractDelimiter($numbers);

		$result = $this->performAdd($numbersWithoutDelimiter);

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

		$number1 = $this->getFirstNumber($numbers);
		$rest = $this->getTailForNumbers($numbers);

		return $number1 + $this->performAdd($rest);
	}

	/**
	 * Get the first number
	 *
	 * @return void
	 */
	private function getFirstNumber($numbers) {
		$firstNumber = (int) $this->splitString($numbers, 0);

		if ($firstNumber < 0) $this->negativeNumbers[] = $firstNumber;

		$firstNumber = $firstNumber > 1000? 0: $firstNumber;

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
		$delimitersRegEx = $this->getDelimiterRegEx();
		$parts = preg_split($delimitersRegEx, $numbers, 2, PREG_SPLIT_NO_EMPTY);

		if (array_key_exists($partToReturn, $parts)) return $parts[$partToReturn];

		return '';
	}

	/*
	 * Return the delimiter regex
	 *
	 * @return void
	 */
	private function getDelimiterRegEx() {
		return '/' . implode('|' , array_map(function ($element) {return '(' . $element . ')';}, $this->delimiters)) . '/';
	}

	/**
	 * Extract the delimiter if there is one
	 *
	 * @return void
	 */
	private function extractDelimiter($numbers) {
		$delimitersString = $this->extractDelimitersString($numbers);

		if (strlen($delimitersString) > 0) {
			if ($this->stringHasMultipleDelimiters($delimitersString)) {
				$this->splitDelimiters($delimitersString);
			} else {
				$this->delimiters = array($delimitersString);
			}

			return substr($numbers, strlen($delimitersString) + 2);
		}

		return $numbers;
	}

	/*
	 * Return the delimiters string
	 *
	 * @return void
	 */
	private function extractDelimitersString($numbers) {
		if (0 === strpos($numbers, '//')) {
			$returnPos = strpos($numbers, "\n");
			$delimiters = substr($numbers, 2, $returnPos - 2);

			return $delimiters;
		}

		return '';
	}

	/*
	 * Check if the delimiter is multiple delimiters
	 *
	 * @return void
	 */
	private function stringHasMultipleDelimiters($delimitersString) {
		return false !== strpos($delimitersString, '[');
	}

	/*
	 * Split the multiple delimiters
	 *
	 * @return void
	 */
	private function splitDelimiters($delimitersString) {
		$this->delimiters = preg_split('/[\[\]]/', $delimitersString, -1, PREG_SPLIT_NO_EMPTY);
	}

}