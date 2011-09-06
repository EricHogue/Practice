<?php
/**
 * BloomFilter
 */
class BloomFilter
{
	/**
	 * @var array
	 */
	private $hashFunctions;

	/**
	 * @var int
	 */
	private $numberOfBytesToUse;


	/**
	 * Class constructor
	 */
	public function __construct(array $hashFunctions, $numberOfBytesToUse)
	{
		$this->hashFunctions = $hashFunctions;
		$this->numberOfBytesToUse = (int) $numberOfBytesToUse;
	}

	/**
	 * Add a word
	 *
	 * @return void
	 */
	public function add($wordToAdd) {
		return true;
	}

	/**
	 * Check if a word exists in the filter
	 *
	 * @return void
	 */
	public function exists($wordToSearch) {

	}


}