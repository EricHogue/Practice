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

	public function nextEmptyCell() {
		$linesCount = $this->criterion->getLineCount();
		$columnsCount = $this->criterion->getColumnCount();

		foreach (range(0, $linesCount - 1) as $lineNumber) {
			foreach (range(0, $columnsCount - 1) as $columnNumber) {
				$coord = new Coordinate($lineNumber, $columnNumber);
				if (!$this->grid->isCellSet($coord)) {
					return $coord;
				}
			}
		}

		return null;
	}

	public function getLineValues($lineNumber) {
		$values = array();

		$columnCount = $this->criterion->getColumnCount();
		foreach (range(0, $columnCount - 1) as $columnNumber) {
			$coord = new Coordinate($lineNumber, $columnNumber);
			if ($this->grid->isCellSet($coord)) {
				$values[] = $this->grid->getValueAtCoordinate($coord);
			}
		}
		sort($values);

		return $values;
	}

	public function getColumnValues($columnNumber) {
		$values = array();

		$lineCount = $this->criterion->getLineCount();
		foreach (range(0, $lineCount - 1) as $lineNumber) {
			$coord = new Coordinate($lineNumber, $columnNumber);
			if ($this->grid->isCellSet($coord)) {
				$values[] = $this->grid->getValueAtCoordinate($coord);
			}
		}
		sort($values);

		return $values;
	}

	public function getSubGridValues($subGridNumber) {
		$startingLine = $this->getStartingLineForSubGrid($subGridNumber);
		$startingColumn = $this->getStartingColumnForSubGrids($subGridNumber, $startingLine);
		$coordinates = $this->getSubGridCoordinates($startingLine, $startingColumn);
		$values = array();

		foreach($coordinates as $coord) {
			if ($this->grid->isCellSet($coord)) {
				$values[] = $this->grid->getValueAtCoordinate($coord);
			}
		}
		sort($values);

		return $values;
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

	private function getSubGridCoordinates($startingLine, $startingColumn) {
		$linesToAdd = $this->criterion->getLinesBySubGrid() - 1;
		$columnsToAdd = $this->criterion->getColumnsBySubGrid() - 1;
		$coordinates = array();

		foreach (range($startingLine, $startingLine + $linesToAdd) as $line) {
			foreach (range($startingColumn, $startingColumn + $columnsToAdd) as $column) {
				$coordinates[] = new Coordinate((int) $line, (int) $column);
			}
		}

		return $coordinates;
	}

}
