<?php

class HashCreatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var HashCreator
	 */
	private $creator;


	public function setup()
	{
		$this->creator = new HashCreator();
	}

	public function testCreate() {
		$this->assertNotNull(new HashCreator());
	}

	public function testGetHashFunctionsReturnArrayWithXFunctions() {
		$functions = $this->creator->getFunctions(4, 10);

		$this->assertSame(4, count($functions));
	}

	public function testGetFunctionsReturnCallables() {
		$functions = $this->creator->getFunctions(4, 10);

		$this->assertTrue(is_callable($functions[3]));
	}

	public function testHashFunctionReturnsIntBetween0AndMaxMinest1() {
		$maxValue = 10;
		$function = $this->creator->getFunctions(1, $maxValue);

		$value = $function[0]('test');
		error_log($value);
		$this->assertTrue($value >= 0 && $value < $maxValue);
	}


	public function testThirdHashFunctionReturnsIntBetween0AndMaxMinest1() {
		$maxValue = 10;
		$function = $this->creator->getFunctions(4, $maxValue);

		$value = $function[2]('test');
		$this->assertTrue($value >= 0 && $value < $maxValue);
	}

	public function test2HashFunctionsReturnsDifferentValues() {
		$functions = $this->creator->getFunctions(2, 10);

		$toHash = 'Test';
		$fistValue = $functions[0]($toHash);
		$secondValue = $functions[1]($toHash);

		$this->assertNotSame($fistValue, $secondValue);
	}
}