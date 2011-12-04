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

}