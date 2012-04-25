<?php

class WordTest extends PHPUnit_Framework_TestCase {
	/** @var Word */
	private $word;

	public function setup() {
		$this->word = new Word('eric');
	}

	public function testKeyIsLettersReordered() {
		$this->assertSame('ceir', $this->word->getKey());
	}

	public function test2WordsAreAnagrams() {
		$this->assertTrue($this->word->isAnagram(new Word('cire')));
	}

	public function test2WordsAreNotAnagrams() {
		$this->assertFalse($this->word->isAnagram(new Word('c1re')));
	}

	public function testSpacesAreIgnoreForAnagramsCheck() {
		$this->assertTrue($this->word->isAnagram(new Word('c i r e')));
	}

	public function testDashesAreIgnoreForAnagramCheck() {
		$this->assertTrue($this->word->isAnagram(new Word('e-r-ic')));
	}

	public function testGetWordReturnTheOriginalWord() {
		$this->assertSame('eric', $this->word->getWord());
	}


}
