<?php
require 'Tests/bootstrap.php';

$numberOfFunctions = 3;
$numberOfBits = 4096;

$hashCreator = new HashCreator();
$functions = $hashCreator->getFunctions($numberOfFunctions, $numberOfBits);

$bloomFilter = new BloomFilter($functions, $numberOfBits);

readDictionary($bloomFilter);

echo $bloomFilter;


/*
 * Read the file
 *
 * @return void
 */
function readDictionary(BloomFilter $filter) {
	error_log('Reading Dictionary');
	$file = fopen('/usr/share/dict/words', 'r');

	while ($line = fgets($file)) {
		$filter->add(trim($line));
	}
	error_log('Done Reading Dictionary');
}