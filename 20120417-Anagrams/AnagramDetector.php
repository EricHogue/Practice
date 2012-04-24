<?php

class AnagramDetector {
	public function getAnagrams(Array $words) {
		$wordsByKey = $this->getWordsArray($words);
		return array_filter($wordsByKey, function($value) {
			return count($value) > 1;
		});
	}

	protected function getWordsArray($originalWords) {
		$wordsByKey = array();

		foreach($originalWords as $plainWord) {
			$wordObject = new Word($plainWord);
			$key = $wordObject->getKey();

			if (!array_key_exists($key, $wordsByKey)) {
				$wordsByKey[$key] = array();
			}

			$wordsByKey[$key][] = $wordObject;
		}

		return $wordsByKey;
	}


}
