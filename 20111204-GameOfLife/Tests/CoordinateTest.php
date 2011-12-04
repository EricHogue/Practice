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

	public function testCellHas8Neighbours() {
		$this->assertSame(8, count($this->coord->getNeighbours()));
	}

	public function testGetCorrectNeighbours() {
		$neighbours = $this->coord->getNeighbours();
		$this->assertTrue(in_array(new Coordinate(2, 4), $neighbours));
		$this->assertTrue(in_array(new Coordinate(3, 4), $neighbours));
		$this->assertTrue(in_array(new Coordinate(4, 4), $neighbours));
		$this->assertTrue(in_array(new Coordinate(2, 5), $neighbours));
		$this->assertTrue(in_array(new Coordinate(4, 5), $neighbours));
		$this->assertTrue(in_array(new Coordinate(2, 6), $neighbours));
		$this->assertTrue(in_array(new Coordinate(3, 6), $neighbours));
		$this->assertTrue(in_array(new Coordinate(4, 6), $neighbours));
	}
}