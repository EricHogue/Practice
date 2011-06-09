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
	private $haystack = array(2, 4, 6, 8, 10, 12, 14);


	public function setup()
	{
		$this->chopper = new KarateChop();
	}

	public function testReturnNegative1ForEmptyArray() {
		$this->assertSame(-1, $this->chopper->chop(1, array()));
	}

	public function testReturnNegative1ForNotFoundValue() {
		$this->assertSame(-1, $this->chopper->chop(1, $this->haystack));
	}

	public function testFindElementInMiddleOfArray() {
		$this->assertSame(3, $this->chopper->chop(8, $this->haystack));
	}
	
	public function testFindElementBeforeMiddleOfArray() {
		$this->assertSame(2, $this->chopper->chop(6, $this->haystack));
	}
	
	public function testFindElementAfterMiddleOfArray() {
		$this->assertSame(5, $this->chopper->chop(12, $this->haystack));
	}
	
	public function testDontFindElementBeforeFirstValue() {
		$this->assertSame(-1, $this->chopper->chop(1, $this->haystack));
	}
	
	public function testDontFindElementAfterLastValue() {
		$this->assertSame(-1, $this->chopper->chop(44564, $this->haystack));
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