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
		$item = $this->getMock('DataItem');
		$this->collection->add($item);
		$this->assertSame(1, $this->collection->count());
	}

	public function testSortCallCompareOnElements() {
		$item1 = $this->getMock('DataItem', array('compare', 'getSpread'));
		$this->collection->add($item1);

		$item2 = $this->getMock('DataItem');
		$item2->expects($this->once())
			->method('compare')
			->will($this->returnValue(1));
		$this->collection->add($item2);

		$this->collection->sort();
	}

	public function testCanGetFirstItemByIndex() {
		$item1 = $this->getMock('DataItem');
		$this->collection->add($item1);

		$this->assertSame($item1, $this->collection[0]);
	}

	public function testCanGetThirdItemByIndex() {
		$this->collection->add($this->getMock('DataItem'));
		$this->collection->add($this->getMock('DataItem'));

		$item3 = $this->getMock('DataItem');
		$this->collection->add($item3);

		$this->collection->add($this->getMock('DataItem'));


		$this->assertSame($item3, $this->collection[2]);
	}

	public function testSortKeepElementIsSameOrderWhenAlreadySorted() {
		$item1 = $this->getMock('DataItem');
		$this->collection->add($item1);

		$item2 = $this->getMock('DataItem');
		$item2->expects($this->any())
			->method('compare')
			->will($this->returnValue(1));
		$this->collection->add($item2);

		$this->collection->sort();

		$this->assertSame($item1, $this->collection[0]);
		$this->assertSame($item2, $this->collection[1]);
	}

	public function testSortReoderCorrectly() {
		$item1 = $this->getMock('DataItem');
		$this->collection->add($item1);

		$item2 = $this->getMock('DataItem');
		$item2->expects($this->any())
			->method('compare')
			->will($this->returnValue(-1));
		$this->collection->add($item2);

		$this->collection->sort();

		$this->assertSame($item2, $this->collection[0]);
		$this->assertSame($item1, $this->collection[1]);
	}
}
