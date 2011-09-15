<?php
require 'Tests/bootstrap.php';

$numberOfFunctions = 3;
$numberOfBits = pow(16, 5);

$hashCreator = new HashCreator();
$functions = $hashCreator->getFunctions($numberOfFunctions, $numberOfBits);

$bloomFilter = new BloomFilter($functions, $numberOfBits);

readDictionary($bloomFilter);

echo $bloomFilter . "\n";
echo 'Number of words in the filter: ' . $bloomFilter->valueCount() . "\n";


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