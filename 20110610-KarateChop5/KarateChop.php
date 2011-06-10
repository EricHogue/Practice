<?php
/**
 * KarateChop
 */
class KarateChop
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function chop($needle, array $haystack) {
		return $this->search($needle, $haystack, 0, count($haystack) - 1);
	}

	/**
	 * search
	 *
	 * @return void
	 */
	private function search($needle, array $haystack, $startIndex, $endIndex) {
		if ($this->isEmpty($startIndex, $endIndex)) return -1;

		$middle = $this->getMiddle($startIndex, $endIndex);
		return $this->testMiddle($needle, $haystack, $startIndex, $endIndex, $middle);
	}

	/**
	 * Test the middle
	 *
	 * @return void
	 */
	private function testMiddle($needle, array $haystack, $startIndex, $endIndex, $middle) {
		$compare = $this->compareValues($needle, $haystack[$middle]);

		if (0 === $compare) return $middle;
		elseif ($compare > 0) return $this->search($needle, $haystack, $middle + 1, $endIndex);
		else return $this->search($needle, $haystack, $startIndex, $middle - 1);
	}

	/**
	 * Get the middle
	 *
	 * @return void
	 */
	private function getMiddle($startIndex, $endIndex) {
		return (int) (($startIndex + $endIndex) / 2);
	}

	/**
	 * Check if empty
	 *
	 * @return void
	 */
	private function isEmpty($startIndex, $endIndex) {
		return ($startIndex > $endIndex);
	}

	/**
	 * Compare values
	 *
	 * @return void
	 */
	private function compareValues($first, $second) {
		if ($first === $second) return 0;
		return ($first - $second);
	}

}