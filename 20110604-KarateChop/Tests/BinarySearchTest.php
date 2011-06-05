<?php
require_once 'BinarySearch.php';

class BinarySearchTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var array
	 */
	private $dataToSeach = array(1, 2, 3, 4, 5);
	
	
	/**
	 * @var BinarySearch
	 */
	private $searcher;
	
	
	public function setup() {
		$this->searcher = new BinarySearch();
	}
	
	public function testMiddleIndexIsSameOnOneElementArray() {
		$middle = $this->searcher->findMiddleIndex(0, 0);
		$this->assertSame(0, $middle);
	}
	
	public function testMiddleIndexIs2WhenStart0AndEnd4() {
		$middle = $this->searcher->findMiddleIndex(0, 4);
		$this->assertSame(2, $middle);
	}
	
	
	public function testMiddleOfEmptyArrayIsNeg1() {
		$middle = $this->searcher->findMiddleIndex(0, -1);
		$this->assertSame(-1, $middle);
	}
	
	public function testMiddleIs0When1Element() {
		$middle = $this->searcher->findMiddleIndex(0, 0);
		$this->assertSame(0, $middle);
	}
	
	public function testMiddleIs2ForArrayOf5() {
		$middle = $this->searcher->findMiddleIndex(0, 4);
		$this->assertSame(2, $middle);
	}
	
	public function testMiddleIs2ForArrayOf6() {
		$middle = $this->searcher->findMiddleIndex(0, 5);
		$this->assertSame(2, $middle);
	}
	
	public function testMiddleIs7WhenStartIs5AndEndIs9() {
		$middle = $this->searcher->findMiddleIndex(5, 9);
		$this->assertSame(7, $middle);
	}
	
	public function testMiddleIs8WhenStartIs6AndEndIs11() {
		$middle = $this->searcher->findMiddleIndex(6, 11);
		$this->assertSame(8, $middle);
	}
	
	public function testElementNotFoundOnEmptyArray() {
		$index = $this->searcher->search(1, array());
		$this->assertSame(-1, $index);
	}
	
	public function testElementNotFoundWhenNotThere() {
		$index = $this->searcher->search(1, array(2, 3, 4));
		$this->assertSame(-1, $index);
	}
	
	public function testElementFoundAt0WhenOnlyElement() {
		$index = $this->searcher->search(1, array(1));
		$this->assertSame(0, $index);
	}
	
	public function testElementFoundWhenInMiddle() {
		$pos = $this->searcher->search(2, array(1, 2, 3));
		$this->assertSame(1, $pos);
	}
	
	public function testElementFoundWhenSmallerThanMiddle() {
		$pos = $this->searcher->search(2, $this->dataToSeach);
		$this->assertSame(1, $pos);
	}
	
	public function testElementFoundWhenBiggerThanMiddle() {
		$pos = $this->searcher->search(4, $this->dataToSeach);
		$this->assertSame(3, $pos);
	}
	
	public function testFindFirstElement() {
		$pos = $this->searcher->search(1, $this->dataToSeach);
		$this->assertSame(0, $pos);
	}
	
	public function testFindLastElement() {
		$pos = $this->searcher->search(5, $this->dataToSeach);
		$this->assertSame(4, $pos);
	}
	
	public function testNOtFoundWhenBeforeFirst() {
		$pos = $this->searcher->search(0, $this->dataToSeach);
		$this->assertSame(-1, $pos);
	}
	
	public function testNOtFoundWhenAfterLast() {
		$pos = $this->searcher->search(6, $this->dataToSeach);
		$this->assertSame(-1, $pos);
	}
	
	public function testNOtFoundWhenMissing() {
		$pos = $this->searcher->search(3, array(1, 2, 4, 5));
		$this->assertSame(-1, $pos);
	}
	
	public function testKataData() {
		$this->assertSame(-1, $this->searcher->search(3, array()));
		$this->assertSame(-1, $this->searcher->search(3, array(1)));
		$this->assertSame(0,  $this->searcher->search(1, array(1)));
		
		$this->assertSame(0,  $this->searcher->search(1, array(1, 3, 5)));
		$this->assertSame(1,  $this->searcher->search(3, array(1, 3, 5)));
		$this->assertSame(2,  $this->searcher->search(5, array(1, 3, 5)));
		$this->assertSame(-1, $this->searcher->search(0, array(1, 3, 5)));
		$this->assertSame(-1, $this->searcher->search(2, array(1, 3, 5)));
		$this->assertSame(-1, $this->searcher->search(4, array(1, 3, 5)));
		$this->assertSame(-1, $this->searcher->search(6, array(1, 3, 5)));
		
		$this->assertSame(0,  $this->searcher->search(1, array(1, 3, 5, 7)));
		$this->assertSame(1,  $this->searcher->search(3, array(1, 3, 5, 7)));
		$this->assertSame(2,  $this->searcher->search(5, array(1, 3, 5, 7)));
		$this->assertSame(3,  $this->searcher->search(7, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->searcher->search(0, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->searcher->search(2, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->searcher->search(4, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->searcher->search(6, array(1, 3, 5, 7)));
		$this->assertSame(-1, $this->searcher->search(8, array(1, 3, 5, 7)));
	}
}