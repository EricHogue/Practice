<?php
class RulesTest extends PHPUnit_Framework_TestCase {
	/** @var Rules */
	private $rules;

	public function setup() {
		$this->rules = new Rules();
	}

	public function testCellWith0NeighboursDies() {
		$this->assertFalse($this->rules->shouldLive(0));
	}

	public function testCellWith1NeighbourDies() {
		$this->assertFalse($this->rules->shouldLive(1));
	}

	public function testCellWith2NeighboursLives() {
		$this->assertTrue($this->rules->shouldLive(2));
	}

	public function testCellWith3NeighboursLives() {
		$this->assertTrue($this->rules->shouldLive(3));
	}

	public function testCellWith4NeighboursDies() {
		$this->assertFalse($this->rules->shouldLive(4));
	}

	public function testCellWith2NeighboursDontSpawnToLife() {
		$this->assertFalse($this->rules->shouldSpawn(2));
	}

	public function testCellWith3NeighboursSpawnToLife() {
		$this->assertTrue($this->rules->shouldSpawn(3));
	}

	public function testCellWith4NeighboursDontSpawnToLife() {
		$this->assertFalse($this->rules->shouldSpawn(4));
	}
}