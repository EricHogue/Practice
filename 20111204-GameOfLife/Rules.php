<?php
class Rules {
	const MIN_POPULATION = 2;
	const MAX_POPULATION = 3;
	const NEEDED_FOR_REPRODUCTION = 3;

	public function __construct() {
	}

	public function shouldLive($neighboursCount) {
		return !$this->isUnderpopulated($neighboursCount) && !$this->isOverPopulated($neighboursCount);
	}

	public function shouldSpawn($neighboursCount) {
		return self::NEEDED_FOR_REPRODUCTION === $neighboursCount;
	}

	protected function isUnderpopulated($neighboursCount) {
		return $neighboursCount < self::MIN_POPULATION;
	}

	protected function isOverPopulated($neighboursCount) {
		return $neighboursCount > self::MAX_POPULATION;
	}

}