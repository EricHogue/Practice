<?php

/**
 * Collection of data object
 */
class DataCollection implements ArrayAccess
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

	/**
	 * Sort the items
	 *
	 * @return void
	 */
	public function sort() {
		usort($this->items, array($this, 'compareItemsOnSpread'));
	}

	public function offsetExists($offset) {
		return array_key_exists($offset, $this->items);
	}

	public function offsetGet($offset) {
		return array_key_exists($offset, $this->items)? $this->items[$offset]: null;
	}

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		unset($this->items[$offset]);
	}

	/**
	 * Compare 2 elements by spread
	 *
	 * @return void
	 */
	private function compareItemsOnSpread(DataItem $item1, DataItem $item2) {
		return $item1->compare($item2);
	}
}