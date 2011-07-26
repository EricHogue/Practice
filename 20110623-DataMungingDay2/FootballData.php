<?php
/**
 * FootballData
 */
class FootballData
{
	/**
	 * @var array
	 */
	private $data = array();

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * count
	 *
	 * @return integer
	 */
	public function count() {
		return count($this->data);
	}

	/**
	 * Parse the data
	 *
	 * @return void
	 */
	public function parse($dataToParse) {
		$lines = explode("\n", $dataToParse);
		array_walk($lines, array($this, 'parseDataLine'));
	}

	/**
	 * getSmallestDifference
	 *
	 * @return void
	 */
	public function getSmallestDifference() {
		if (0 === $this->count()) throw new Exception('No data to sort');

		$sortedData = $this->data;
		usort($sortedData, array($this, 'compareDiff'));

		return $sortedData[0];
	}

	/**
	 * Parse one line
	 *
	 * @return void
	 */
	private function parseDataLine($textLine) {
		$data = new TeamData();
		if ($data->parse($textLine)) {
			$this->data[] = $data;
		}
	}

	/**
	 * Compare the diffs between 2 data row
	 *
	 * @return void
	 */
	private function compareDiff(TeamData $data1, TeamData $data2) {
		$diff1 = $data1->getGoalsDifference();
		$diff2 = $data2->getGoalsDifference();

		return ($diff1 - $diff2);
	}

}