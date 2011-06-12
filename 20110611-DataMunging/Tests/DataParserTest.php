<?php
class DataParserTest extends PHPUnit_Framework_TestCase {
	const DATA_LINE = '   1  88    59    74          53.8       0.00 F       280  9.6 270  17  1.6  93 23 1004.5';
	/**
	 * @var DataParser
	 */
	private $parser;
	
	
	public function setup() {
		$this->parser = new DataParser();
	}
	
	public function testLoadingAnEmptyFileReturnAnArray() {
		$this->assertInternalType('array', $this->parser->parse(''));
	}
	
	public function testEmptyDataReturnEmptyArray() {
		$this->assertEmpty($this->parser->parse(''));
	}
	
	public function testOneDayOfDataReturnsArrayOfOneElement() {
		$this->assertSame(1, count($this->parser->parse($this->getDataFromFile('weather1Line.dat'))));	
	}
	
	public function testLineNotStartingByDayIsNotData() {
		$this->assertFalse($this->parser->isDataLine('(Unofficial, Preliminary Data). Source: <a'));
	}
	
	public function testLineThatStartWithNumberIsDataLine() {
		$this->assertTrue($this->parser->isDataLine(self::DATA_LINE));
	}
	
	public function testLineWithoutEnoughColumnsIsNotDataLine() {
		$this->assertFalse($this->parser->isDataLine('1 34 34'));
	}
	
	public function testTotalLineIsNotADataLine() {
		$this->assertFalse($this->parser->isDataLine('  mo  82.9  60.5  71.7    16  58.8       0.00              6.9          5.3'));
	}
	
	public function testParsingALineReadTheDay() {
		$this->assertSame(1, $this->parser->parseLine(self::DATA_LINE)->getDay());
	}
	
	public function testParsingALineReadTheMaximum() {
		$this->assertSame(88, $this->parser->parseLine(self::DATA_LINE)->getMaximum());
	}
	
	public function testParsingALineReadTheMinimum() {
		$this->assertSame(59, $this->parser->parseLine(self::DATA_LINE)->getMinimum());
	}
	
	public function testParsingTheFileReturns30Rows() {
		$this->assertSame(30, count($this->parser->parse($this->getDataFromFile('weather.dat'))));
	}
	
	public function test14thDaySpreadIs2() {
		$parsedData = $this->parser->parse($this->getDataFromFile('weather.dat'));
		$this->assertSame(2, $parsedData[14]->getTemperatureSpread());
	}
	
	/*
	 * Get the data from a file
	 *
	 * @return void
	 */
	private function getDataFromFile($fileName) {
		return file_get_contents('Tests/' . $fileName, true);
	}
}
