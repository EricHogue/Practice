<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{



    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

	private $order;

	/**
	 * @Given /^an empty order$/
	 */
	public function anEmptyOrder()
	{
		$this->order = new Order();
	}

	/**
	 * @Then /^the price is (\d+)$/
	 */
	public function thePriceIs($argument1)
	{
		assertSame(0, $this->order->total());
	}


	/**
	 * @When /^I add (\d+) item "([^"]*)"$/
	 */
	public function iAddItem($argument1, $argument2)
	{
		throw new PendingException();
	}

}
