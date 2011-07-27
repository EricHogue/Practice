<?php

/**
 * Collection of data object
 */
class DataCollection
{
	/**
	 * @var array
	 */
	private $items = array();


	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * The number of element in the collection
	 *
	 * @return void
	 */
	public function count() {
		return count($this->items);
	}

	/**
	 * Add an item to the collection
	 *
	 * @return void
	 */
	public function add(DataItem $item) {
		$this->items[] = $item;
	}


}