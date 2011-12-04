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
		$this->addCells('1Cell');
		$this->assertFalse($this->board->isEmpty());
	}

	public function testNextBoardOnEmptyBoardReturnANewBoard() {
		$newBoard = $this->board->nextBoard();
		$this->assertInstanceOf('Board', $newBoard);
	}

	public function testNextBoardOnEmptyBoardReturnAnEmptyBoard() {
		$newBoard = $this->board->nextBoard();
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWithOneCellReturnAnEmptyBoard() {
		$this->addCells('1Cell');
		$newBoard = $this->board->nextBoard();
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWith2CellsReturnsAnEmptyBoard() {
		$this->addCells('2Cells');
		$newBoard = $this->board->nextBoard();
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardOnBoardWith3NonAdjacentCellsReturnsAnEmptyBoard() {
		$this->addCells('3NonAdjacentCells');
		$newBoard = $this->board->nextBoard();
		$this->assertTrue($newBoard->isEmpty());
	}

	public function testNextBoardIsNotEmptyWith3AdjacentCells() {
		$this->markTestSkipped();
		$this->addCells('3AdjacentCells');
		$newBoard = $this->board->nextBoard();
		$this->assertFalse($newBoard->isEmpty());
	}


	private function addCells($configName) {
		$cells = $this->cells[$configName];

		$board = $this->board;
		$adding = function($cellInfo) use ($board) {
			$board->addCell(new Coordinate($cellInfo[0], $cellInfo[1]));
		};

		array_walk($cells, $adding);
	}

	/** @var array */
	private $cells = array(
		'1Cell' => array(array(3, 5)),
		'2Cells' => array(array(3, 5), array(4, 5)),
		'3NonAdjacentCells' => array(array(3, 5), array(4, 5), array(7, 5)),
		'3AdjacentCells' => array(array(3, 5), array(4, 5), array(5, 5)),
	);

}