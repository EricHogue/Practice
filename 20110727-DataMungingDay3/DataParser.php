<?php
/**
 * DataParser
 */
class DataParser
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Parse
	 *
	 * @return DataCollection
	 */
	public function parse($itemClass, $dataToParse) {
		if (!class_exists($itemClass, true)) throw new Exception("Class {$itemClass} does not exist");

		return new DataCollection();
	}

}