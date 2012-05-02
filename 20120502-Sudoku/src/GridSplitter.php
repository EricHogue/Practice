<?php

class GridSplitter {
	/** @var Grid */
	private $grid;

	/** @var GridCriterion */
	private $criterion;

	public function __construct(Grid $grid, GridCriterion $criterion) {
		$this->grid = $grid;
		$this->criterion = $criterion;
	}

	public function getLines() {
		$lines = array();
		foreach (range(0, $this->criterion->getLineCount() - 1) as $lineNumber) {
			$lines[] = $this->getValuesFromLine($lineNumber);
		}

		return $lines;
	}

	public function getColumns() {
		$columns = array();
		foreach (range(0, $this->criterion->getColumnCount() - 1) as $columnNumber) {
			$columns[] = $this->getValuesFromColumn($columnNumber);
		}

		return $columns;
	}

	public function getSubGrids() {
		$subGrids = array();
		foreach(range(0, $this->criterion->getSubGridCount() - 1) as $subGridNumber) {
			$startingLine = $this->getStartingLineForSubGrid($subGridNumber);
			$startingColumn = $this->getStartingColumnForSubGrids($subGridNumber, $startingLine);

			$subGrids[] = $this->getSubGridFromPosition($startingLine, $startingColumn);
		}

		return $subGrids;
	}

	private function getValuesFromLine($line) {
		$grid = $this->grid;
		$func = function($column) use ($line, $grid) {
			return $grid->getValueAtCoordinate(new Coordinate($line, $column));
		};

		return array_map($func, range(0, $this->criterion->getColumnCount() - 1));
	}

	private function getValuesFromColumn($column) {
		$grid = $this->grid;
		$func = function($line) use ($column, $grid) {
			return $grid->getValueAtCoordinate(new Coordinate($line, $column));
		};

		return array_map($func, range(0, $this->criterion->getLineCount() - 1));
	}

	private function getStartingLineForSubGrid($subGrid) {
		$linesBySubGrid = $this->criterion->getLinesBySubGrid();
		return floor(($subGrid) / $linesBySubGrid) * $linesBySubGrid;
	}

	private function getStartingColumnForSubGrids($subGrid, $startingLine) {
		return floor(($subGrid - $startingLine)) * $this->criterion->getColumnsBySubGrid();
	}

	private function getSubGridFromPosition($startingLine, $startingColumn) {
		$linesToAdd = $this->criterion->getLinesBySubGrid() - 1;
		$columnsToAdd = $this->criterion->getColumnsBySubGrid() - 1;
		$subGrid = array();

		foreach (range($startingLine, $startingLine + $linesToAdd) as $line) {
			foreach (range($startingColumn, $startingColumn + $columnsToAdd) as $column) {
				$subGrid[] = $this->grid->getValueAtCoordinate(new Coordinate($line, $column));
			}
		}

		return $subGrid;
	}
}
