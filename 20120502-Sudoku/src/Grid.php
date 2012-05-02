<?php

class Grid {
	/** @var array */
	private $cells = array();

	public function cellsCount() {
		return count($this->cells);
	}

	public function addCell(Coordinate $coordinate, $value) {
		$this->cells[$coordinate->getKey()] = $value;
	}

	public function getValueAtCoordinate(Coordinate $coordinate) {
		if (!$this->isCellSet($coordinate)) throw new CellNotSetException();

		return $this->cells[$coordinate->getKey()];
	}

	public function isCellSet(Coordinate $coordinate) {
		return array_key_exists($coordinate->getKey(), $this->cells);
	}
}
