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

	public function testExceptionContainsNegativeValue() {
		try {
			$this->calculator->add('1, -3');
		} catch (Exception $e) {
			$message = $e->getMessage();
		}

		$this->assertTrue(strpos($message, '-3') !== false);
	}

	public function testExceptionContainsAllNegativeNumbers() {
		try {
			$this->calculator->add('1, -3,-2,9,-5,9');
		} catch (Exception $e) {
			$message = $e->getMessage();
		}

		$this->assertTrue(strpos($message, '-3, -2, -5') !== false);
	}

	public function testNumberGreaterThan1000AreIgnore() {
		$this->assertSame(2, $this->calculator->add('1001,2'));
	}

	public function testAllowDelimiterOfAnyLength() {
		$this->assertSame(6, $this->calculator->add("//[\*\*\*]\n1***2***3"));
	}

	public function testDontDetectUnknowSeparators() {
		$this->assertNotSame(6, $this->calculator->add("//[\+-]\n1*k*2*k*3"));
	}


	public function testAllowDelimiterWithDifferentChars() {
		$this->assertSame(6, $this->calculator->add("//[\*]\n1*k*2*k*3"));
	}

	public function testAllowMultipleDelimiters() {
		$this->assertSame(6, $this->calculator->add("//[\*][%]\n1*2%3"));
	}

	public function testMultipleDelimitersOfAnyLength() {
		$this->assertSame(21, $this->calculator->add("//[qwe][-][kfsjadflk][kj]\n1kj2kfsjadflk3qwe4-5kj6"));
	}

}