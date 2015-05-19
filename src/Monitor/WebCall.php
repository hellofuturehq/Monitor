<?php

namespace HelloFuture\Monitor;

abstract class WebCall extends Call {

	public function __invoke() {
		$result = parent::__invoke();
		$result->url = $this->getUrl();
		return $result;
	}

	protected function execute() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$this->getUrl());
		$result=curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	abstract public function getUrl();

}
