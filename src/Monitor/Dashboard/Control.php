<?php

namespace HelloFuture\Monitor\Dashboard;

use ArrayAccess;
use DOMDocument;
use DOMXpath;
use RunTimeException;
use HelloFuture\Monitor\Call;

class Control implements ArrayAccess {

	protected $call;
	protected $params = [];

	public function __construct($call) {
		$this->call = $call;
	}

	public function getCall() {
		return $this->call;
	}

	public function offsetGet($key) {
		return $this->params[$key];
	}

	public function offsetSet($key, $value) {
		$this->params[$key] = $value;
	}

	public function offsetExists($key) {
		return isset($this->params[$key]);
	}

	public function offsetunset($key) {
		unset($this->params[$key]);
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
