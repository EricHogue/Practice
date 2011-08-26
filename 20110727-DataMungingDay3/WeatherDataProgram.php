<?php

include 'Tests/bootstrap.php';

$parser = new FileParser();
$collection = $parser->parse('Data/weather.dat', 'WeatherDataItem');
$collection->sort();

echo 'Smallest Spread: ' . $collection[0]->getSpread() . "\n";
print_r($collection[0]);