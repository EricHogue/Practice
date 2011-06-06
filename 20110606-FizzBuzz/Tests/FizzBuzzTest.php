<?php
require_once 'FizzBuzz.php';

class FizzBuzzTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var FizzBuzz
	 */
	private $fizzBuzz;


	/**
	 * Setup the test case
	 */
	public function setup() {
		$this->fizzBuzz = new FizzBuzz();
	}


	public function testSay1For1() {
		$this->assertSame(1, $this->fizzBuzz->say(1));
	}

	public function testSayFizzFor3() {
		$this->assertSame('Fizz', $this->fizzBuzz->say(3));
	}

	public function testSayBuzzFor5() {
		$this->assertSame('Buzz', $this->fizzBuzz->say(5));
	}

	public function testSayFizzBuzzFor15() {
		$this->assertSame('FizzBuzz', $this->fizzBuzz->say(15));
	}

	/**
	 * @dataProvider provider
	 */
	public function testTestMulti($value, $result) {
		$this->assertEquals($result, $this->fizzBuzz->say($value));
	}

	/**
	 * Data provider
	 *
	 * @return void
	 */
	public function provider() {
		return array(
			array(1, 1),
			array(2, 2),
			array(3, 'Fizz'),
			array(4, 4),
			array(5, 'Buzz'),
			array(6, 'Fizz'),
			array(7, 7),
			array(8, 8),
			array(9, 'Fizz'),
			array(10, 'Buzz'),
			array(11, 11),
			array(12, 'Fizz'),
			array(13, 13),
			array(14, 14),
			array(15, 'FizzBuzz'),
			array(16, 16),
			array(17, 17),
			array(18, 'Fizz'),
			array(19, 19),
			array(20, 'Buzz'),
			array(21, 'Fizz'),
			array(22, 22),
			array(23, 23),
			array(24, 'Fizz'),
			array(25, 'Buzz'),
			array(26, 26)
		);
	}
}