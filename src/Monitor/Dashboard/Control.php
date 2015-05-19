<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;
use HelloFuture\Monitor\Call;

class Control {

	protected $call;
	protected $params;

	public function __construct($call) {
		$this->call   = $call;
		$this->params = (object) [];
	}

	public function getCall() {
		return $this->call;
	}

	public function __get($key) {
		return $this->params->$key;
	}

	public function __set($key, $value) {
		$this->params->$key = $value;
	}

	public function __isset($key) {
		return isset($this->params->$key);
	}

	public function __unset($key) {
		unset($this->params->$key);
	}

	public function getParams() {
		return $this->params;
	}

	public function run() {
		$className = $this->getCall();
		$call      = new $className($this->getParams());
		return $call();
	}

}
