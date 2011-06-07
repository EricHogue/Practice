<?php

class KarateChopTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var KarateChop
	 */
	private $chopper;

	/**
	 * @var array
	 */
	private $haystack = array(1, 5, 7, 8, 10, 32, 478);


	public function setup()
	{
		$this->chopper = new KarateChop();
	}

	public function testReturnNegative1ForEmptyArray() {
		$this->assertSame(-1, $this->chopper->chop(1, array()));
	}

	public function testReturnNegative1ForUnexistingNeedle() {
		$this->assertSame(-1, $this->chopper->chop(2, $this->haystack));
	}

	public function testFindNeedleWhenItsTheOnlyElement() {
		$this->assertSame(0, $this->chopper->chop(1, array(1)));
	}

	public function testFindElementWhenInCenter() {
		$this->assertSame(3, $this->chopper->chop(8, $this->haystack));
	}

	public function testFindElementWhenBeforeMiddle() {
		$this->assertSame(1, $this->chopper->chop(5, $this->haystack));
	}

	public function testFindElementWhenAfterMiddle() {
		$this->assertSame(6, $this->chopper->chop(478, $this->haystack));
	}

	public function testDontFindBeforeArray() {
		$this->assertSame(-1, $this->chopper->chop(0, $this->haystack));
	}

	public function testDontFindAfterArray() {
		$this->assertSame(-1, $this->chopper->chop(479, $this->haystack));
	}

	public function testFindInArrayWithEvenNumberOfElements() {
		$haystack = $this->haystack;
		$haystack[] = 500;

		$this->assertSame(4, $this->chopper->chop(10, $haystack));
	}

}