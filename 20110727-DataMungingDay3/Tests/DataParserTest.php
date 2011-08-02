<?php

class DataParserTest extends PHPUnit_Framework_TestCase
{

	public function setup()
	{
	}

	public function testCreateParser() {
		$this->assertNotNull(new DataParser());
	}

	public function testParseEmptyStringReturnsEmptyCollection() {
		$parser = new DataParser();
		$collection = $parser->parse('', '');

		$this->assertSame(0, $collection->count());
	}

	/**
	 * @expectedException Exception
	 */
	public function testParseWithInexistingClassThrowAnException() {
		$parser = new DataParser();
		$collection = $parser->parse('DataItem', '');
	}

}