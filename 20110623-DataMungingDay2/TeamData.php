<?php
/**
 * TeamData
 */
class TeamData
{
	const PARSE_REGEX = '/^\d{1,2}\.\s*(\w+)\s*\d{1,2}\s*\d{1,2}\s*\d{1,2}\s*\d{1,2}\s*(\d{1,2})\s*-\s*(\d{1,2})\s*\d{1,2}$/';

	/**
	 * @var string
	 */
	private $teamName;

	/**
	 * @var int
	 */
	private $forGoals;

	/**
	 * @var int
	 */
	private $againstGoals;



	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Parse
	 *
	 * @return boolean
	 */
	public function parse($dataString) {
		if (1 === preg_match(self::PARSE_REGEX, trim($dataString), $matches)) {
			$this->teamName = $matches[1];
			$this->forGoals = (int) $matches[2];
			$this->againstGoals = (int) $matches[3];

			return true;
		} else {
			return false;
		}
	}

	/**
	 * Return the team name
	 *
	 * @return void
	 */
	public function getTeamName() {
		return $this->teamName;
	}

	/**
	 * getTeamForGoals
	 *
	 * @return void
	 */
	public function getTeamForGoals() {
		return $this->forGoals;
	}

	/**
	 * getTeamAgainstGoals
	 *
	 * @return void
	 */
	public function getTeamAgainstGoals() {
		return $this->againstGoals;
	}

	/**
	 * getGoalsDifference
	 *
	 * @return void
	 */
	public function getGoalsDifference() {
		return abs($this->forGoals - $this->againstGoals);
	}
}