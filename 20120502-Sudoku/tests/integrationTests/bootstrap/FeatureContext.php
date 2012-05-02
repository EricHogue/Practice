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

//
// Place your definition and hook methods here:

	private $grid;

	/**
	 * @Given /^an empty grid$/
	 */
	public function anEmptyGrid()
	{
		$this->grid = new Grid();
	}

	/**
	 * @Given /^an incomplete grid$/
	 */
	public function anIncompleteGrid()
	{
		$loader = new Loader();
		$this->grid = $loader->loadFromFile('data/sudoku1_almost_solved.txt');
	}

	/**
	 * @Then /^I should not be winning$/
	 */
	public function iShouldNotBeWinning()
	{
		assertFalse($this->getValidator()->isValidGrid());
	}


	/**
	 * @When /^I add a duplicate value$/
	 */
	public function iAddADuplicateValue()
	{
		$this->grid->addCell(new Coordinate(6, 2), 2);
	}


	/**
	 * @When /^I add the correct value$/
	 */
	public function iAddTheCorrectValue()
	{
		$this->grid->addCell(new Coordinate(6, 2), 9);
	}

	/**
	 * @Then /^I should be winning$/
	 */
	public function iShouldBeWinning()
	{
		assertTrue($this->getValidator()->isValidGrid());
	}


	private function getValidator() {
		$criterion = new GridCriterion();
		return new Validator($this->grid, new GridSplitter($this->grid, $criterion), $criterion);
	}
}
