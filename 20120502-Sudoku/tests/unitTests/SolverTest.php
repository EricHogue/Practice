<?php

class SolverTest extends PHPUnit_Framework_TestCase {
	public function testCreate() {
		$this->assertNotNull(new Solver());
	}

	/**
	 * @expectedException EmptyGridException
	 */
	public function testSolvingAnEmptyGridThrowsAnError() {
		$solver = new Solver();
		$solver->solve(new Grid());
	}
}
