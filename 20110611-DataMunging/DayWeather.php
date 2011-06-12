<?php
/**
 * DayWeather
 */
class DayWeather {
	/**
	 * @var integer
	 */
	private $minimum;
	
	/**
	 * @var integer
	 */
	private $maximum;
	
	/**
	 * @var integer
	 */
	private $day;
	
	
	public function __construct($day, $minimum, $maximum) {
		$this->day = (int) $day;
		$this->minimum = (int) $minimum;
		$this->maximum = (int) $maximum;
	}
	
	/*
	 * Return the day
	 *
	 * @return integer
	 */
	public function getDay() {
		return $this->day;
	}
	
	/*
	 * Return the minimum of the day
	 *
	 * @return void
	 */
	public function getMinimum() {
		return $this->minimum;
	}
	
	/*
	 * Return the maximum of the day
	 *
	 * @return void
	 */
	public function getMaximum() {
		return $this->maximum;
	}
	
	/*
	 * Return the temperature spread
	 *
	 * @return void
	 */
	public function getTemperatureSpread() {
		return $this->maximum - $this->minimum;
	}
}