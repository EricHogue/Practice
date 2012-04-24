<?php

class AnagramDetectorTest extends PHPUnit_Framework_TestCase {
	/** @var AnagramDetector */
	private $detector;

	public function setup() {
		$this->detector = new AnagramDetector();
	}

	public function testEmptyListHasNoAnagram() {
		$this->assertEmpty($this->detector->getAnagrams(array()));
	}

	public function testOneWordAsNoAnagram() {
		$this->assertEmpty($this->detector->getAnagrams(array('eric')));
	}

	public function testTwoWordsAreNotAnagram() {
		$this->assertEmpty($this->detector->getAnagrams(array('eric', 'jfdslk')));
	}

	public function testTwoAnagramsAreDetected() {
		$this->assertCount(1, $this->detector->getAnagrams(array('eric', 'ci-re')));
	}
}
