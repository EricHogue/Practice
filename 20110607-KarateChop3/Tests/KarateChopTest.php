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
	
	public function testKataTests() {
		$this->assertSame(-1, $this->chopper->chop(3, array()));
		$this->assertSame(-1, $this->chopper->chop(3, array(1)));
		$this->assertSame(0,  $this->chopper->chop(1, array(1)));
		
		$this->assertSame(0,  $this->chopper->chop(1, array(1, 3, 5)));
		$this->assertSame(1,  $this->chopper->chop(3, array(1, 3, 5)));
		$this->assertSame(2,  $this->chopper->chop(5, array(1, 3, 5)));
		$this->assertSame(-1, $this->chopper->chop(0, array(1, 3, 5)));
		$this->assertSame(-1, $this->chopper->chop(2, array(1, 3, 5)));
		$this->assertSame(-1, $this->chopper->chop(4, array(1, 3, 5)));
		$this->assertSame(-1, $this->chopper->chop(6, array(1, 3, 5)));
		
		$this->assertSame(0,  $this->chopper->chop(1, array(1, 3, 5, 7)));
		$this->assertSame(1,  $this->chopper->chop(3, array(1, 3, 5, 7)));
		$this->assertSame(2,  $this->chopper->chop(5, array(1, 3, 5, 7)));
		$this->assertSame(3,  $this->chopper->chop(7, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->chopper->chop(0, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->chopper->chop(2, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->chopper->chop(4, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->chopper->chop(6, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->chopper->chop(8, array(1, 3, 5, 7)));
	}

}