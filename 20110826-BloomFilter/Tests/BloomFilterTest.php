<?php
class BloomFilterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var BloomFilter
	 */
	private $bloomFilter;


	public function setup()
	{
		$hashCreator = new HashCreator();
		$numberOfBytestToUse = 16;

		$functions = $hashCreator->getFunctions(3, $numberOfBytestToUse);
		$this->bloomFilter = new BloomFilter($functions, $numberOfBytestToUse);
	}

	public function testCreate() {
		$this->assertNotNull(new BloomFilter(array(), 1));
	}

	public function testAddingAWordReturnsTrue() {
		$this->assertTrue($this->bloomFilter->add('test'));
	}

	public function testInexistentWordNotFound() {
		$this->assertFalse($this->bloomFilter->exists('ksadfkal'));
	}
}