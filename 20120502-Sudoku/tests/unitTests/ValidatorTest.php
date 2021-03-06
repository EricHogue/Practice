<?php

class ValidatorTest extends PHPUnit_Framework_TestCase {
	/** @var Grid */
	private $grid;

	/** @var GridSplitter */
	private $splitter;

	/** @var GridCriterion */
	private $criterion;

	/** @var Validator */
	private $validator;

	public function setup() {
		$this->grid = $this->getMock('Grid');
		$this->criterion = $this->getMock('GridCriterion');
		$this->splitter = $this->getMock('GridSplitter', array('getLines', 'getColumns', 'getSubGrids'),
			array($this->grid, $this->criterion));

		$this->splitter->expects($this->any())
			->method('getColumns')
			->will($this->returnValue(array(array(1, 2, 3))));
		$this->splitter->expects($this->any())
			->method('getSubGrids')
			->will($this->returnValue(array(array(1, 2, 3), array(4, 5, 6))));

		$this->validator = new Validator($this->grid, $this->splitter, $this->criterion);
	}

	public function testBoardDoesNotHaveAllValuesSet() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(4));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(5));

		$this->assertFalse($this->validator->areAllValuesSet());
	}

	public function testBoardHasAllValuesSet() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(5));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(5));

		$this->assertTrue($this->validator->areAllValuesSet());
	}

	public function testHaveSomeInvalidValue() {
		$this->criterion->expects($this->exactly(4))
			->method('isValueValid')
			->will($this->onConsecutiveCalls(true, true, true, false));

		$this->assertFalse($this->validator->areValuesValid(array(1, 2, 3, 4, 5)));
	}

	public function testValuesAreValid() {
		$this->criterion->expects($this->exactly(3))
			->method('isValueValid')
			->will($this->returnValue(true));

		$this->assertTrue($this->validator->areValuesValid(array(1, 2, 3)));
	}

	public function testHaveNoDuplicate() {
		$this->assertFalse($this->validator->haveDuplicates(array(1, 2, 3, 4, 5)));
	}

	public function testHaveDuplicates() {
		$this->assertTrue($this->validator->haveDuplicates(array(1, 2, 3, 4, 5, 3)));
	}

	public function testGridWhitoutAllValuesSetIsNotValid() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(4));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(5));

		$this->assertFalse($this->validator->isValidGrid());
	}

	public function testGridWithInvalidValuesIsNotValid() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(4));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(4));

		$this->splitter->expects($this->once())
			->method('getLines')
			->will($this->returnValue(array(array(1, 2, 3, 4))));

		$this->criterion->expects($this->exactly(3))
			->method('isValueValid')
			->will($this->onConsecutiveCalls(true, true, false));

		$this->assertFalse($this->validator->isValidGrid());
	}

	public function testGridWithDuplicatesInNotValid() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(4));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(4));

		$this->splitter->expects($this->once())
			->method('getLines')
			->will($this->returnValue(array(array(1, 3, 2, 3))));

		$this->criterion->expects($this->any())
			->method('isValueValid')
			->will($this->returnValue(true));

		$this->assertFalse($this->validator->isValidGrid());
	}

	public function testGridWithAllConditionsMetIsValid() {
		$this->grid->expects($this->once())
			->method('cellsCount')
			->will($this->returnValue(4));

		$this->criterion->expects($this->once())
			->method('numberOfNeededValues')
			->will($this->returnValue(4));

		$this->splitter->expects($this->once())
			->method('getLines')
			->will($this->returnValue(array(array(1, 4, 2, 3))));

		$this->criterion->expects($this->any())
			->method('isValueValid')
			->will($this->returnValue(true));

		$this->assertTrue($this->validator->isValidGrid());
	}

}
