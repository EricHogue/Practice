<?php

class AnagramDetectorTest extends PHPUnit_Framework_TestCase {

	public function testCreate() {
		$this->assertNotNull(new AnagramDetector());
	}

	public function testEmptyListHasNoAnagram() {
		$detector = new AnagramDetector();
		$this->assertEmpty($detector->getAnagrams(array()));
	}

	public function testOneWordAsNoAnagram() {

	}
}
