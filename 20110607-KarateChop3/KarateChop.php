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
	 * Chop
	 *
	 * @return void
	 */
	public function chop($needle, array $haystack) {
		$middle = (int) ((0 + count($haystack) - 1) / 2);
		if (array_key_exists($middle, $haystack) && $needle === $haystack[$middle]) return $middle;

		return $this->searchSubArray($needle, $haystack, 0, count($haystack) - 1);

		return -1;
	}

	/**
	 * Description
	 *
	 * @return void
	 */
	private function searchSubArray($needle, array $haystack, $startIndex, $endIndex) {
		if ($startIndex > $endIndex) return -1;

		$middle = (int) (($startIndex + $endIndex) / 2);
		$middleValue = $haystack[$middle];

		if ($needle === $middleValue) return $middle;
		if ($needle < $middleValue) return $this->searchSubArray($needle, $haystack, 0, $middle - 1);
		else if ($needle > $middleValue) return $this->searchSubArray($needle, $haystack, $middle + 1, $endIndex);
	}

}