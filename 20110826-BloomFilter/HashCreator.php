<?php
/**
 * HashCreator
 */
class HashCreator
{
	const HASH_ALGO = 'sha256';

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Return the hash functions
	 *
	 * @return void
	 */
	public function getFunctions($functionCount, $numberOfBits) {
		$functions = array();
		$algo = self::HASH_ALGO;

		for ($i = 0; $i < $functionCount; $i++) {
			$functions[] = function ($toHash) use ($algo) {
				return (int) hash($algo, $toHash);
			};
		}

		return $functions;
	}
}