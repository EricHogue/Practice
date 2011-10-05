<?php
class StringCalculatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var StringCalculator
	 */
	private $calculator;


	public function setup()
	{
		$this->calculator = new StringCalculator();
	}

	public function testCreate() {
		$this->assertNotNull(new StringCalculator());
	}

	public function testAddReturn0ForEmptyString() {
		$this->assertSame(0, $this->calculator->add(''));
	}

	public function testAddReturnsTheNumberWhenOnlyOneNumberGiven() {
		$this->assertSame(5, $this->calculator->add('5'));
	}

	public function testAdd2NumbersSeparateByACommaReturnsTheSumOfBoth() {
		$this->assertSame(6, $this->calculator->add('2,4'));
	}

	public function testCanAdd3Numbers() {
		$this->assertSame(16, $this->calculator->add('4,5,7'));
	}

	public function testCanAddMultipleNumbers() {
		$numbers = array(1, 2, 3, 565, 643, 234, 342, 3, 0, 324);

		$sum = array_reduce($numbers, function($initial, $number) {return $initial + $number;}, 0);

		$this->assertSame($sum, $this->calculator->add(implode(',', $numbers)));
	}

	public function testAddOnlyASpaceIs0() {
		$this->assertSame(0, $this->calculator->add(' '));
	}

	public function testSpacesInNumbersAreIgnored() {
		$this->assertSame(9, $this->calculator->add('	 1	, 3	,  	 5 '));
	}

	public function testSeparateNumbersByLineFeed() {
		$this->assertSame(3, $this->calculator->add("1\n2"));
	}

	public function testSeparateNumbersByCommaAndLineFeed() {
		$this->assertSame(10, $this->calculator->add("1  ,  2,   3    \n     4"));
	}

	public function testAllowPassingDelimiter() {
		$this->assertSame(3, $this->calculator->add("//;\n1;2"));
	}

	/**
	 * @expectedException Exception
	 */
	public function testNegativeNumbersThrowAnException() {
		$this->calculator->add("-1,1");
	}
}