<?php
class CoordinateTest extends PHPUnit_Framework_TestCase {
	const X = 3;
	const Y = 5;

	/** @var Coordinate */
	private $coord;

	public function setup() {
		$this->coord = new Coordinate(self::X, self::Y);
	}

	public function testCanReadX() {
		$this->assertSame(3, $this->coord->getX());
	}

	public function testCanReadY() {
		$this->assertSame(5, $this->coord->getY());
	}

	public function testHashReturnConcatOfBothCoordinates() {
		$this->assertSame(self::X . '-' . self::Y, $this->coord->hash());
	}
}