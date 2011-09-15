<?php
class FactorialTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var Factorial
	 */
	private $factorial;


	public function setup()
	{
		$this->factorial = new Factorial();
	}

	public function testCreate() {
		$this->assertNotNull(new Factorial());
	}

	public function testFactorialOf0Is1() {
		$this->assertSame(1, $this->factorial->computeFactorial(0));
	}

	public function testFactorialOf1Is1() {
		$this->assertSame(1, $this->factorial->computeFactorial(1));
	}

	public function testFactorialOf2Is2() {
		$this->assertSame(2, $this->factorial->computeFactorial(2));
	}

	public function testFactorialOf3Is6() {
		$this->assertSame(6, $this->factorial->computeFactorial(3));
	}

	public function testFactorialOf10Is3628800() {
		$this->assertSame(3628800, $this->factorial->computeFactorial(10));
	}
}