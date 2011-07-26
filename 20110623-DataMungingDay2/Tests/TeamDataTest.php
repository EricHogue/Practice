<?php
class TeamDataTest extends PHPUnit_Framework_TestCase
{
	const DATA_LINE = '    9. Tottenham       38    14   8  16    49  -  53    50';

	/**
	 * @var TeamData
	 */
	private $data;

	public function setup()
	{
		$this->data = new TeamData();
		$this->data->parse(self::DATA_LINE);
	}

	public function testCreate() {
		$this->assertNotNull(new TeamData());
	}

	public function testparsingInvalidStringReturnsFalse() {
		$this->assertFalse($this->data->parse('lasfkjd dfalsj '));
	}

	public function testParsingValidStringReturnsTrue() {
		$this->assertTrue($this->data->parse(self::DATA_LINE));
	}

	public function testParseReadTheTeamName() {
		$this->assertSame('Tottenham', $this->data->getTeamName());
	}

	public function testParseReadTheGoalsFor() {
		$this->assertSame(49, $this->data->getTeamForGoals());
	}

	public function testParseReadTheGoalsAgainst() {
		$this->assertSame(53, $this->data->getTeamAgainstGoals());
	}

	public function testReturnTheGoalDifference() {
		$this->assertSame(4, $this->data->getGoalsDifference());
	}
}