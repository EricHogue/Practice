<?php

class DataParserTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DataParser
	 */
	private $parser;

	public function setup()
	{
		$this->parser = new DataParser();
	}

	public function testCreateParser() {
		$this->assertNotNull(new DataParser());
	}

	public function testParseEmptyStringReturnsEmptyCollection() {
		$collection = $this->parser->parse('DataParser', '');

		$this->assertSame(0, $collection->count());
	}

	/**
	 * @expectedException Exception
	 */
	public function testParseWithInexistingClassThrowsAnException() {
		$collection = $this->parser->parse('InvalidClass', '');
	}

}