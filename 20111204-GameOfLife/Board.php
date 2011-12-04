<?php
class Board {
	/** @var array */
	private $coordinates;

	public function __construct() {
		$this->coordinates = array();
	}

	public function isEmpty() {
		return 0 === count($this->coordinates);
	}

	public function addCell(Coordinate $coordinate) {
		$this->coordinates[$coordinate->hash()] = $coordinate;
	}

	/**
	 * @return Board
	 */
	public function nextBoard() {
		return new Board();
	}


}