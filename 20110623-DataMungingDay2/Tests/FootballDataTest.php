<?php

class FootballDataTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var FootballData
	 */
	private $data;


	public function setup()
	{
		$this->data = new FootballData();
	}

	public function testCreate() {
		$this->assertNotNull(new FootballData());
	}

	public function testCountIs0WhenNothingWasParsed() {
		$this->assertSame(0, $this->data->count());
	}

	public function testParseBadDateReturns0DataRows() {
		$this->data->parse('jfkla asfdljf;sajkfda;sfj;asd dsfl jfsad');
		$this->assertSame(0, $this->data->count());
	}

	public function testParsingTheFileReturns20Rows() {
		$this->data->parse(file_get_contents('Data/football.dat', true));
		$this->assertSame(20, $this->data->count());
	}

	/**
	 *
	 * @expectedException Exception
	 */
	public function testThrowExceptionWhenNoData() {
		$this->data->getSmallestDifference();
	}

	public function testFindRowWithSmallestDiff() {
		$this->data->parse(file_get_contents('Data/football.dat', true));
		$team = $this->data->getSmallestDifference();

		$expectedTeam = new TeamData();
		$expectedTeam->parse('    8. Aston_Villa     38    12  14  12    46  -  47    50');

		$this->assertEquals($expectedTeam, $team);
	}
}
