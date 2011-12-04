<?php
class Coordinate {
	/** @var int */
	private $x;

	/** @var int */
	private $y;


	public function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}

	public function getX() {
		return $this->x;
	}

	public function getY() {
		return $this->y;
	}

	public function hash() {
		return $this->x . '-' . $this->y;
	}

	public function getNeighbours() {
		$neighbours = array();
		for ($x = $this->x - 1; $x <= $this->x + 1; $x++) {
			for ($y = $this->y - 1; $y <= $this->y + 1; $y++) {
				if ($x != $this->x || $y != $this->y) $neighbours[] = new Coordinate($x, $y);
			}
		}

		return $neighbours;
	}

}