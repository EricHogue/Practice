<?php
require_once 'KarateChop.php';

class KarateChopTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var KarateChop
	 */
	private $chopper;
	
	/**
	 * @var array
	 */
	private $haystack = array(1, 3, 5, 7, 9);
	
	
	public function setup() {
		$this->chopper = new KarateChop();
	}
	
	public function testChopReturnsNegative1ForEmptyArray() {
		$this->assertSame(-1, $this->chopper->chop(1, array()));
	}
	
	public function testReturnNegative1ForNotFoundValue() {
		$this->assertSame(-1, $this->chopper->chop(2, array(1, 3, 4)));
	}
	
	public function testReturn0WhenchopForOnlyElementInArray() {
		$this->assertSame(0, $this->chopper->chop(3, array(3)));
	}
	
	public function testReturns2WhenElementInMiddleOfOddArray() {
		$this->assertSame(2, $this->chopper->chop(5, $this->haystack));
	}
	
	public function testReturnCorrectElementWhenValueIsSmallerThanMiddle() {
		$this->assertSame(1, $this->chopper->chop(3, $this->haystack));
	}
	
	public function testFindElementAfterMiddle() {
		$this->assertSame(3, $this->chopper->chop(7, $this->haystack));
	}
	
	public function testDontFindValueSmallerThanHaystack() {
		$this->assertSame(-1, $this->chopper->chop(0, $this->haystack));
	}
	
	public function testDontFindValueBiggerThanHaystackBiggest() {
		$this->assertSame(-1, $this->chopper->chop(100, $this->haystack));
	}
	
	public function testFindValueBeforeMiddleInHaystackWithAnEvenCountOfElements() {
		$haystack = $this->haystack;
		$haystack[] = 10;
		$this->assertSame(2, $this->chopper->chop(5, $haystack));
	}
	
	public function testFindValueAfterMiddleInHaystackWithAnEvenCountOfElements() {
		$haystack = $this->haystack;
		$haystack[] = 10;
		$this->assertSame(3, $this->chopper->chop(7, $haystack));
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