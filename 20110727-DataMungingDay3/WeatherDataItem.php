<?php
/**
 * WeatherDataItem
 */
class WeatherDataItem extends DataItem
{
	/**
	 * @var int
	 */
	private $day;

	/**
	 * @var int
	 */
	private $minimum;

	/**
	 * @var int
	 */
	private $maximum;


	/**
	 * Class constructor
	 */
	public function __construct($day = -1, $minimum =  0, $maximum = 0)
	{
		$this->day = $day;
		$this->minimum = $minimum;
		$this->maximum = $maximum;
	}

	/**
	 * Get the spread
	 *
	 * @return void
	 */
	public function getSpread() {
		return $this->maximum - $this->minimum;
	}

	/**
	 * parse
	 *
	 * @return void
	 */
	public function parse($dataLine) {
		throw new Exception('Not Implemented yet');
	}

}