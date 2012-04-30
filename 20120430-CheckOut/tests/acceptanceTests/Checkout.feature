Feature: Perform a checkout at the registry
	In order to get the total price
	As a user
	I need to compute the price by item

	Scenario: Empty order is free
		Given an empty order
		Then the price is 0
