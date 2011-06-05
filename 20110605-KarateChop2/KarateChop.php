<?php
class KarateChop {
	/*
	 * Do the binary search
	 *
	 * @return void
	 */
	public function chop($needle, array $haystack) {
		$middle = $this->getMiddle(0, count($haystack) - 1);
		if (array_key_exists($middle, $haystack) && $needle === $haystack[$middle]) return $middle;
		
		$startIndex = 0;
		$endIndex = count($haystack) - 1;
		while ($startIndex <= $endIndex) {
			$middle = $this->getMiddle($startIndex, $endIndex);
			$middleValue = $haystack[$middle];
			
			if ($needle === $middleValue) return $middle;
			else if ($needle < $middleValue) $endIndex = $middle - 1;
			else $startIndex = $middle + 1;
		}
		
		return -1;
	}
	
	/*
	 * Return the middle between 2 boundaries
	 *
	 * @return void
	 */
	private function getMiddle($startIndex, $endIndex) {
		return (int) floor(($startIndex + $endIndex) / 2);
	}
}