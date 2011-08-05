<?php

/**
 * Base class for data items
 */
abstract class DataItem
{
	/**
	 * @var int
	 */
	protected $id = -1;

	abstract function getSpread();

	abstract function parse($dataLine);

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct($id = -1) {
		$this->id = $id;
	}

	/**
	 * Return the id
	 *
	 * @return void
	 */
	public function getID() {
		return $this->id;
	}

	function compare(DataItem $item2) {
		return $this->getSpread() - $item2->getSpread();
	}
}