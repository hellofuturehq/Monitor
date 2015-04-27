<?php

namespace HelloFuture\Monitor\Dashboard;

use \DOMDocument;

class Dashboard {

	protected $config;

	public function __construct($configPath) {
		$this->config = new DOMDocument();
		$this->config->load($configPath);
	}

	public function getRootNode() {
		return $this->config->documentElement;
	}

	public function isValid() {
		return $this->getRootNode()->nodeName == 'dashboard';
	}

}
