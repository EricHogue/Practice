<?php

class GridSplitterTest extends PHPUnit_Framework_TestCase {
	/** @var GridSplitter */
	private $splitter;

	/** @var Grid */
	private $grid;

	public function setup() {
		$callback = function(Coordinate $coordinate) {
			return $coordinate->getKey();
		};

		$this->grid = $this->getMock('Grid');
		$this->grid->expects($this->any())
			->method('getValueAtCoordinate')
			->will($this->returnCallback($callback));

		$this->splitter = new GridSplitter($this->grid, new GridCriterion());
	}

	public function testGetLinesReturns9Lines() {
		$this->assertSame(9, count($this->splitter->getLines()));
	}

	public function testLine5ContainsAllTheCorrectValues() {
		$expected = array('5-0', '5-1', '5-2', '5-3', '5-4', '5-5', '5-6', '5-7', '5-8');
		$lines = $this->splitter->getLines();
		$this->assertSame($expected, $lines[5]);
	}

	public function testGetColumnsReturns9Columns() {
		$this->assertSame(9, count($this->splitter->getColumns()));
	}

	public function testColumn8ContainsAllTheCorrectValues() {
		$expected = array('0-8', '1-8', '2-8', '3-8', '4-8', '5-8', '6-8', '7-8', '8-8');
		$columns = $this->splitter->getColumns();
		$this->assertSame($expected, $columns[8]);
	}

	public function testHas9SubGrids() {
		$this->assertSame(9, count($this->splitter->getSubGrids()));
	}

	public function testSubGrids4HasAllTheCorrectValues() {
		$expected = array('3-3', '3-4', '3-5', '4-3', '4-4', '4-5', '5-3', '5-4', '5-5');
		$subGrids = $this->splitter->getSubGrids();
		$this->assertSame($expected, $subGrids[4]);
	}

	public function testSubGrids8HasAllTheCorrectValues() {
		$expected = array('6-6', '6-7', '6-8', '7-6', '7-7', '7-8', '8-6', '8-7', '8-8');
		$subGrids = $this->splitter->getSubGrids();
		$this->assertSame($expected, $subGrids[8]);
	}

	public function testNextEmptyCellIs0_0ForEmptyGrid() {
		$this->assertEquals(new Coordinate(0, 0), $this->splitter->nextEmptyCell());
	}

	public function testWhen0_0IsSetNextEmptyCellIs0_1() {
		$this->grid->expects($this->any())
			->method('isCellSet')
			->will($this->onConsecutiveCalls(true, false));
		$this->assertEquals(new Coordinate(0, 1), $this->splitter->nextEmptyCell());
	}

	public function testWhenFirst2RowsAreSetNextEmptyCellIs2_4() {
		$this->grid->expects($this->any())
			->method('isCellSet')
			->will($this->onConsecutiveCalls(true, true, true, true, true, true, true, true, true, true, true, true,
				true, true, true, true, true, true, true, true, true, true, false));
		$this->assertEquals(new Coordinate(2, 4), $this->splitter->nextEmptyCell());
	}

}
