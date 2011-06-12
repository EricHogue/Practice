<?php
/**
 * DataParser
 */
class DataParser {
	const MINIMUM_COLUMN_COUNT = 15;
	
	public function __construct() {
	}
	
	/*
	 * Parse a data file
	 *
	 * @return void
	 */
	public function parse($data) {
		$parsedData = array();		
		$splitedData = explode("\n", $data);
		
		foreach ($splitedData as $line) {
			if ($this->isDataLine($line)) {
				$day = $this->parseLine($line);
				$parsedData[$day->getDay()] = $day;
			}
		}
		
		return $parsedData;
	}
	
	/*
	 * Check if a line contains parsable data
	 *
	 * @return void
	 */
	public function isDataLine($line) {
		$data = preg_split('/\s/', trim($line));
		
		if (count($data) >= self::MINIMUM_COLUMN_COUNT && is_numeric($data[0])) return true;
		
		return false;
	}
	
	/*
	 * Parse one line of the data
	 *
	 * @return DayWeather
	 */
	public function parseLine($line) {
		$data = preg_split('/\s+/', trim($line));
		
		return new DayWeather($data[0], $data[2], $data[1]);
	}
}