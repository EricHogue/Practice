<?php
class DayWeatherTest extends PHPUnit_Framework_TestCase {
	const MINIMUM = 13;
	const MAXIMUM = 31;
	const DAY = 4;
	
	/**
	 * @var DayWeather
	 */
	private $weather;
	
	
	public function setup() {
		$this->weather = new DayWeather(self::DAY, self::MINIMUM, self::MAXIMUM);
	}
	
	public function testReturnMin() {
		$this->assertEquals(self::MINIMUM, $this->weather->getMinimum());
	}
	
	public function testReturnMaximum() {
		$this->assertEquals(self::MAXIMUM, $this->weather->getMaximum());
	}
	
	public function testTemperatureSpread() {
		$this->assertEquals(self::MAXIMUM - self::MINIMUM, $this->weather->getTemperatureSpread());
	}
	
	public function testGetDay() {
		$this->assertSame(self::DAY, $this->weather->getDay());
	}
}