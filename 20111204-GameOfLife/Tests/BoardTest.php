<?php
class BoardTest extends PHPUnit_Framework_TestCase {
	/** @var Board */
	private $board;

	public function setup() {
		$this->board = new Board();
	}

	public function testNewBoardIsEmpty() {
		$this->assertTrue($this->board->isEmpty());
	}

	public function testBoardIsNotEmptyAfterAddingACell() {
		$this->addCells($this->board, '1Cell');
		$this->assertFalse($this->board->isEmpty());
	}

	public function testNextBoardOnEmptyBoardReturnANewBoard() {
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertInstanceOf('Board', $newBoard);
	}

	public function testNextBoardOnEmptyBoardReturnAnEmptyBoard() {
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWithOneCellReturnAnEmptyBoard() {
		$this->addCells($this->board, '1Cell');
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWith2CellsReturnsAnEmptyBoard() {
		$this->addCells($this->board, '2Cells');
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWith3NonAdjacentCellsReturnsAnEmptyBoard() {
		$this->addCells($this->board, '3NonAdjacentCells');
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardIsNotEmptyWith3AdjacentCells() {
		$this->addCells($this->board, '3AdjacentCells');
		$newBoard = $this->board->nextBoard(new Rules());
		$this->assertFalse($newBoard->isEmpty());
	}

	public function testCountLivingNeighboursOnEmptyBoardIs0() {
		$this->assertSame(0, $this->board->countLivingNeighbours(new Coordinate(2, 3)));
	}

	public function testDetectOneLivingNeighbours() {
		$this->addCells($this->board, '3AdjacentCells');
		$this->assertSame(1, $this->board->countLivingNeighbours(new Coordinate(2, 4)));
	}

	public function testDetect2LivingNeighbours() {
		$this->addCells($this->board, '3AdjacentCells');
		$this->assertSame(2, $this->board->countLivingNeighbours(new Coordinate(3, 6)));
	}

	public function testDetect3LivingNeighbours() {
		$this->addCells($this->board, '3AdjacentCells');
		$this->assertSame(3, $this->board->countLivingNeighbours(new Coordinate(4, 6)));
	}

	public function testDetectLivingNeighboursAllAround() {
		$this->addCells($this->board, 'full9Cells');
		$this->assertSame(8, $this->board->countLivingNeighbours(new Coordinate(4, 5)));
	}

	public function testHasCellIsFalseForInexistingCell() {
		$this->assertFalse($this->board->hasCell(new Coordinate(4, 5)));
	}

	public function testHasCellIsTrueForExistingCell() {
		$this->addCells($this->board, '3AdjacentCells');
		$this->assertTrue($this->board->hasCell(new Coordinate(4, 5)));
	}

	public function testSpawning() {
		$this->addCells($this->board, 'spawnTest');
		$newBoard = $this->board->nextBoard(new Rules());

		$this->assertTrue($this->compareToExpectedBoard($newBoard, '1Cell'));
	}

	public function testGetPotentialForSpawning() {
		$this->addCells($this->board, '3AdjacentCells');
		$expected = array(
			'2-4' => new Coordinate(2, 4), '2-5' => new Coordinate(2, 5), '2-6' => new Coordinate(2, 6),
			'3-4' => new Coordinate(3, 4), '3-6' => new Coordinate(3, 6),
			'4-4' => new Coordinate(4, 4), '4-6' => new Coordinate(4, 6),
			'5-4' => new Coordinate(5, 4), '5-6' => new Coordinate(5, 6),
			'6-4' => new Coordinate(6, 4), '6-5' => new Coordinate(6, 5), '6-6' => new Coordinate(6, 6),
		);
		$this->assertEquals($expected, $this->board->getPotentialForSpawning());
	}

	public function testBlock() {
		$this->addCells($this->board, 'block');
		$nextBoard = $this->board->nextBoard(new Rules());

		$this->assertTrue($this->compareToExpectedBoard($nextBoard, 'block'));
	}

	public function testBeehive() {
		$this->addCells($this->board, 'beehive');
		$nextBoard = $this->board->nextBoard(new Rules());

		$this->assertTrue($this->compareToExpectedBoard($nextBoard, 'beehive'));
	}


	public function testBlinker() {
		$this->addCells($this->board, 'blinkerPeriod1');
		$nextBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($this->compareToExpectedBoard($nextBoard, 'blinkerPeriod2'));

		$board3 = $nextBoard->nextBoard(new Rules());
		$this->assertTrue($this->compareToExpectedBoard($board3, 'blinkerPeriod1'));
	}

	public function testToad() {
		$this->addCells($this->board, 'toadPeriod1');
		$nextBoard = $this->board->nextBoard(new Rules());
		$this->assertTrue($this->compareToExpectedBoard($nextBoard, 'toadPeriod2'));

		$board3 = $nextBoard->nextBoard(new Rules());
		$this->assertTrue($this->compareToExpectedBoard($board3, 'toadPeriod1'));
	}


	private function addCells(Board $board, $configName) {
		$cells = $this->cells[$configName];

		$adding = function($cellInfo) use ($board) {
			$board->addCell(new Coordinate($cellInfo[0], $cellInfo[1]));
		};

		array_walk($cells, $adding);
	}

	private function compareToExpectedBoard(Board $returnedBoard, $expectedBoardConfig) {
		$expectedBoard = new Board();
		$this->addCells($expectedBoard, $expectedBoardConfig);

		return $returnedBoard == $expectedBoard;
	}



	/** @var array */
	private $cells = array(
		'1Cell' => array(array(4, 5)),
		'2Cells' => array(array(3, 5), array(4, 5)),
		'3NonAdjacentCells' => array(array(3, 5), array(4, 5), array(7, 5)),
		'3AdjacentCells' => array(array(3, 5), array(4, 5), array(5, 5)),
		'full9Cells' => array(
			array(3, 4), array(4, 4), array(5, 4),
			array(3, 5), array(4, 5), array(5, 5),
			array(3, 6), array(4, 6), array(5, 6),
		),
		'spawnTest' => array(array(3, 4), array(5, 4), array(4, 6)),
		'block' => array(array(2, 2), array(3, 2), array(2, 3), array(3, 3)),
		'beehive' => array(
			array(3, 2), array(4, 2),
			array(2, 3), array(5, 3),
			array(3, 4), array(4, 4),
		),
		'blinkerPeriod1' => array(array(2, 3), array(3, 3), array(4, 3)),
		'blinkerPeriod2' => array(array(3, 2), array(3, 3), array(3, 4)),
		'toadPeriod1' => array(array(3, 3), array(4, 3), array(5, 3), array(2, 4), array(3, 4), array(4, 4)),
		'toadPeriod2' => array(array(4, 2), array(2, 3), array(5, 3), array(2, 4), array(5, 4), array(3, 5)),

	);

}