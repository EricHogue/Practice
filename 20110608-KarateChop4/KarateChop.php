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
	 * chop
	 *
	 * @return void
	 */
	public function chop($needle, array $haystack) {
		$position = $this->search($needle, $haystack, 0, count($haystack) - 1);
		return (false !== $position? $position: -1);
	}

	/**
	 * Perform the search
	 *
	 * @return void
	 */
	private function search($needle, array $haystack, $startIndex, $endIndex) {
		$middle = (int) (($startIndex + $endIndex) / 2);
		return ($startIndex <= $endIndex?  ($needle === $haystack[$middle]? $middle: ($needle < $haystack[$middle]? $this->search($needle, $haystack, 0, $middle - 1): $this->search($needle, $haystack, $middle + 1, $endIndex))): false);
	}

}