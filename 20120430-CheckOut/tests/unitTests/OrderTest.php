<?php

class OrderTest extends PHPUnit_Framework_TestCase {
	public function testCreate() {
		$this->assertNotNull(new Order());
	}

	public function testEmptyOrderIsFree() {
		$order = new Order();
		$this->assertSame(0, $order->total());
	}

}
