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
}