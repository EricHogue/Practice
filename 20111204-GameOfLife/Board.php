<?php
class Board {
	/** @var array */
	private $coordinates;

	/** @var Rules */
	private $rules;


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
	public function nextBoard(Rules $rules) {
		$this->rules = $rules;
		$survivingCells = array_filter($this->coordinates, array($this, 'shouldCellSurvive'));
		$newCells = array_filter($this->getPotentialForSpawning(), array($this, 'shouldCellSpawn'));

		$newBoard = new Board();
		$newBoard->coordinates = array_merge($survivingCells, $newCells);

		return $newBoard;
	}

	public function shouldCellSurvive(Coordinate $cell) {
		return $this->rules->shouldLive($this->countLivingNeighbours($cell));
	}

	public function shouldCellSpawn(Coordinate $cell) {
		return $this->rules->shouldSpawn($this->countLivingNeighbours($cell));
	}

	public function countLivingNeighbours(Coordinate $cell) {
		return count(array_filter($cell->getNeighbours(), array($this, 'hasAlivedCell')));
	}

	public function hasCell(Coordinate $cell) {
		return array_key_exists($cell->hash(), $this->coordinates);
	}

	protected function hasAlivedCell(Coordinate $cell) {
		return array_key_exists($cell->hash(), $this->coordinates);
	}

	public function getPotentialForSpawning() {
		$potentials = array_reduce($this->coordinates, function(array $potentials, Coordinate $coordinate) {
			foreach ($coordinate->getNeighbours() as $neighbour) {
				$potentials[$neighbour->hash()] = $neighbour;
			}
			return $potentials;
		}, array());

		$cells = $this->coordinates;
		return array_filter($potentials, function(Coordinate $coordinate) use ($cells) {
			return !array_key_exists($coordinate->hash(), $cells);
		});
	}
}