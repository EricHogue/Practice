<?php

/**
 * Base class for data items
 */
interface DataItem
{
	function getSpread();

	function compare(DataItem $item2);
}