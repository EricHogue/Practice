<?php
/**
 * FootballDataItem
 */
class FootballDataItem extends DataItem
{
	const PARSE_REGEX = '/^\d{1,2}\.\s*(\w+)\s*\d{1,2}\s*\d{1,2}\s*\d{1,2}\s*\d{1,2}\s*(\d{1,2})\s*-\s*(\d{1,2})\s*\d{1,2}$/';

	/**
	 * @var int
	 */
	private $goalsFor = 0;

	/**
	 * @var int
	 */
	private $goalsAgainst = 0;


	/**
	 * Class constructor
	 */
	public function __construct($id = -1, $goalsFor = 0, $goalsAgaints = 0)
	{
		$this->goalsFor = $goalsFor;
		$this->goalsAgainst = $goalsAgaints;
	}

	/**
	 * Return the spread
	 *
	 * @return integer
	 */
	public function getSpread() {
		return abs($this->goalsFor - $this->goalsAgainst);
	}

	/**
	 * Parse the football data line
	 *
	 * @return void
	 */
	public function parse($dataLine) {
		if (1 === preg_match(self::PARSE_REGEX, trim($dataLine), $matches)) {
			$this->id = $matches[1];
			$this->goalsFor = (int) $matches[2];
			$this->goalsAgainst = (int) $matches[3];

			return true;
		} else {
			return false;
		}
	}
}