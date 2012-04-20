<?php

class Word {
	/** @var array */
	private $charsToIgnore = array(' ', '-');

	/** @var string */
	private $theWord;

	/** @var string */
	private $key;

	public function __construct($theWord) {
		$this->theWord = $theWord;
	}

	public function getKey() {
		if (! isset($this->key)) {
			$characters = str_split(str_replace($this->charsToIgnore, '', $this->theWord));
			sort($characters);
			$this->key = implode($characters);
		}

		return $this->key;
	}

	public function isAnagram(Word $otherWord){
		return 0 === strcasecmp($this->getKey(), $otherWord->getKey());
	}
}
