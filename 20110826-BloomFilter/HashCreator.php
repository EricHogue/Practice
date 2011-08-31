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
		$neededChars = $this->neededCharsForXBits($numberOfBits);



		for ($functionIndex = 0; $functionIndex < $functionCount; $functionIndex++) {
			$functions[] = function ($toHash) use ($algo, $neededChars, $functionIndex) {
				$hash = hash($algo, $toHash);
				$partialHash = substr($hash, $neededChars * $functionIndex, $neededChars);
				$value = base_convert($partialHash, 16, 10);

				return $value;
			};
		}

		return $functions;
	}

	/**
	 * Check how many chars are needed for X bits
	 *
	 * @return void
	 */
	public function neededCharsForXBits($numbersOfBits) {
		return (int) ceil($numbersOfBits / 16);
	}
}