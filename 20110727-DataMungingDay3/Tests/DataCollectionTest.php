<?php

class DataCollectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DataCollection
	 */
	private $collection;


	public function setup()
	{
		$this->collection = new DataCollection();
	}

	public function testCreate() {
		$this->assertNotNull(new DataCollection());
	}

	public function testCountOfEmptyCollectionIsZero() {
		$this->assertSame(0, $this->collection->count());
	}

	public function testCountIsOneAfterAddingAnElement() {
		$this->collection->add(1);
		$this->assertSame(1, $this->collection->count());
	}


}