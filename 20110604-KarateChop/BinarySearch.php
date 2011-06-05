<?php
class BinarySearch {	
	public function search($valueToSearch, array $array) {
		return $this->searchSubArray($valueToSearch, $array, 0, count($array) - 1);
	}
	
	/*
	 * Find the middle index
	 *
	 * @return void
	 */
	public function findMiddleIndex($startIndex, $endIndex) {
		return (int) floor(($startIndex + $endIndex) / 2);
	}
	
	/*
	 * Perform the search on a sub array
	 *
	 * @return void
	 */
	private function searchSubArray($valueToSearch, array $array, $startIndex, $endIndex) {
		if ($endIndex < $startIndex) return -1;
		
		$middle = $this->findMiddleIndex($startIndex, $endIndex);
		$middleValue = $array[$middle];
		
		if ($valueToSearch === $middleValue) return $middle;
		elseif ($valueToSearch < $middleValue) return $this->searchSubArray($valueToSearch, $array, $startIndex, $middle -1);
		else return $this->searchSubArray($valueToSearch, $array, $middle + 1, $endIndex);
	}
}
