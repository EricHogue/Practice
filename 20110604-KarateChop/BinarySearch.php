<?php
class BinarySearch {	
	public function search($value, $array) {
		if (empty($array)) return -1;
		
		$middle = $this->findMiddleIndex(0, count($array) - 1);
		if ($array[$middle] === $value) return $middle; 
		if ($value < $array[$middle] && $value === $array[$middle - 1]) return $middle -1;
		
		return -1;
	}
	
	/*
	 * Find the middle index
	 *
	 * @return void
	 */
	public function findMiddleIndex($startIndex, $endIndex) {
		if ($endIndex < $startIndex) return -1;
		return (int) floor(($startIndex + $endIndex) / 2);
	}
}
