<?php
/**
 * WeatherDataItem
 */
class WeatherDataItem extends DataItem
{
	const MINIMUM_COLUMN_COUNT = 15;

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
		if ($this->isDataLineValid($dataLine)) {
			$data = preg_split('/\s+/', trim($dataLine));

			$this->day = $data[0];
			$this->minimum = $data[2];
			$this->maximum = $data[1];

			return true;
		} else {
			throw new Exception('Invalid data line');
		}
	}


	/**
	 * Check if the data is valid
	 *
	 * @return boolean
	 */
	private function isDataLineValid($dataLine) {
		$data = preg_split('/\s/', trim($dataLine));

		if (count($data) >= self::MINIMUM_COLUMN_COUNT && is_numeric($data[0])) return true;

		return false;
	}

}