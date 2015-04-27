<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;

class Control {

	protected $type;
	protected $call;

	public function __construct($type, $call) {
		$this->type = $type;
		$this->call = $call;
	}

	public function getType() {
		return $this->type;
	}

	public function getCall() {
		return $this->call;
	}

}
