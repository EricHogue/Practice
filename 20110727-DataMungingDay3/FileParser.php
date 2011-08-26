<?php
/**
 * FileParser
 */
class FileParser
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Parse a file
	 *
	 * @return DataCollection
	 */
	public function parse($file, $dataClass) {
		$collection = new DataCollection();

		$content = explode("\n", $this->readFile($file));

		foreach ($content as $line) {
			$item = new $dataClass();
			if ($item->parse($line)) {
				$collection[] = $item;
			}
		}

		return $collection;
	}

	/**
	 * Read the file
	 *
	 * @return void
	 */
	private function readFile($file) {
		if (file_exists($file)) {
			return file_get_contents($file, true);
		}

		return '';
	}

}