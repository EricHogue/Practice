<?php
require('bootstrap.php');

$content = readWordsFromFile('data/words.txt');
$detector = new AnagramDetector();
$anagrams = $detector->getAnagrams($content);

foreach ($anagrams as $words) {
	foreach($words as $word) {
		echo $word->getWord() . "\t";
	}
	echo "\n";
}

function readWordsFromFile($fileName) {
	return explode("\n", file_get_contents($fileName));
}
