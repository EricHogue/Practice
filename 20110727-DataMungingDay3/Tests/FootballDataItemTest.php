<?php
class FootballDataItemTest extends PHPUnit_Framework_TestCase
{
	const DATA = '   13. Fulham          38    10  14  14    36  -  44    44';

	/**
	 * @var FootballDataItem
	 */
	private $item;

	public function setup()
	{
		$this->item = new FootballDataItem();
	}

	public function testCreate() {
		$this->assertNotNull(new FootballDataItem());
	}

	public function testGetSpreadReturns0WhenNoDataHaveBeenPassed() {
		$this->assertSame(0, $this->item->getSpread());
	}

	public function testGetSpreadReturnsCorrectValueWhenGoalsForIsBiggerThenGoalsAgainst() {
		$item = new FootballDataItem(0, 10, 3);
		$this->assertSame(7, $item->getSpread());
	}


	public function testGetSpreadReturnsCorrectValueWhenGoalsForIsLowerThenGoalsAgainst() {
		$item = new FootballDataItem(0, 2, 3);
		$this->assertSame(1, $item->getSpread());
	}

	public function testParseInvalidDataReturnsFalse() {
		$this->assertFalse($this->item->parse('kdjfas'));
	}

	public function testParseValidDataReturnTrue() {
		$this->assertTrue($this->item->parse(self::DATA));
	}

	public function testParseValidLineReturnsTheCorrectSpread() {
		$this->item->parse(self::DATA);
		$this->assertSame(8, $this->item->getSpread());
	}

	public function testParseValidDataGetsTheCorrectName() {
		$this->item->parse(self::DATA);
		$this->assertSame('Fulham', $this->item->getID());
	}
}