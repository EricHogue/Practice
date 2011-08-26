<?php
class FileParserTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var FileParser
	 */
	private $parser;


	public function setup()
	{
		$this->parser = new FileParser();
	}

	public function testCreate() {
		$this->assertNotNull(new FileParser());
	}

	public function testParseFileReturnsADataCollection() {
		$this->assertInstanceOf('DataCollection', $this->parser->parse('', 'FootballDataItem'));
	}

	public function testParseFootballDataReturnsCorrectNumberOfLines() {
		$collection = $this->parser->parse('Data/football.dat', 'FootballDataItem');
		$this->assertSame(20, $collection->count());
	}

	public function testParseWeatherDataReturnsCorrectNumberOfLines() {
		$collection = $this->parser->parse('Data/weather.dat', 'WeatherDataItem');
		$this->assertSame(30, $collection->count());
	}
}