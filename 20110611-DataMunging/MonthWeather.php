<?php
/**
 * MonthWeather
 */
class MonthWeather
{
	/**
	 * @var array
	 */
	private $data;


	/**
	 * Class constructor
	 */
	public function __construct(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Get the count
	 *
	 * @return integer
	 */
	public function getCount() {
		return count($this->data);
	}

	/**
	 * getSmallestSpreadDay
	 *
	 * @return DayWeather
	 */
	public function getSmallestSpreadDay() {
		$data = $this->getDataSortedByTemperatureSpread();
		return $data[0];
	}

	/**
	 * getBiggestSpreadDay
	 *
	 * @return DayWeather
	 */
	public function getBiggestSpreadDay() {
		$data = $this->getDataSortedByTemperatureSpread();
		return $data[count($data) - 1];
	}

	/**
	 * Return the data for a day
	 *
	 * @return void
	 */
	public function getDay($day) {
		if (array_key_exists($day, $this->data)) {
			return $this->data[$day];
		} else {
			return null;
		}
	}

	/**
	 * Sort the data by temperature spread
	 *
	 * @return array
	 */
	private function getDataSortedByTemperatureSpread() {
		$data = $this->data;
		usort($data, array($this, 'compareSpread'));

		return $data;
	}

	/**
	 * Compare to DayWeahter
	 *
	 * @return void
	 */
	private function compareSpread(DayWeather $day1, DayWeather $day2) {
		$spread1 = $day1->getTemperatureSpread();
		$spread2 = $day2->getTemperatureSpread();

		return ($spread1 - $spread2);
	}

}