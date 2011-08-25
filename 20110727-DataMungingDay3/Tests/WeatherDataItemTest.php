<?php
class WeatherDataItemTest extends PHPUnit_Framework_TestCase
{
	const DATA = '   1  88    59    74          53.8       0.00 F       280  9.6 270  17  1.6  93 23 1004.5';

	/**
	 * @var DataItem
	 */
	private $item;


	public function setup()
	{
		$this->item = new WeatherDataItem();
	}

	public function testCreate() {
		$this->assertNotNull(new WeatherDataItem());
	}

	public function testInitialSpreadIs0() {
		$item = new WeatherDataItem();
		$this->assertSame(0, $item->getSpread());
	}

	public function testGetSpreadReturnsCorrectValue() {
		$item = new WeatherDataItem(1, 10, 31);
		$this->assertSame(21, $item->getSpread());
	}

	/**
	 * @expectedException Exception
	 */
	public function testParseInvalidDataThrowAnException() {
		$this->item->parse('fjdlksj fd;asdfj');
	}

	public function testParseValidDataReturnsTrue() {
		$this->assertTrue($this->item->parse(self::DATA));
	}
}