<?php
class MonthWeatherTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var MonthWeather
	 */
	private $weather;

	public function setup() {
		$data = array();
		$data[1] = new DayWeather(1, 20, 40);
		$data[2] = new DayWeather(2, 10, 145);
		$data[3] = new DayWeather(3, 45, 46);
		$data[4] = new DayWeather(4, 45, 47);

		$this->weather = new MonthWeather($data);
	}


	public function testCountIs0OnEmptyData() {
		$weather = new MonthWeather(array());
		$this->assertSame(0, $weather->getCount());
	}

	public function testCountIsCorrect() {
		$this->assertSame(4, $this->weather->getCount());
	}

	public function testGetSmallestSpreadDay() {
		$this->assertEquals(new DayWeather(3, 45, 46), $this->weather->getSmallestSpreadDay());
	}

	public function testGetBiggestSpreadDay() {
		$this->assertEquals(new DayWeather(2, 10, 145), $this->weather->getBiggestSpreadDay());
	}

	public function testGettingADay() {
		$this->assertEquals(new DayWeather(3, 45, 46), $this->weather->getDay(3));
	}

	public function testGetNullForInexistingDay() {
		$this->assertNull($this->weather->getDay(5));
	}
}