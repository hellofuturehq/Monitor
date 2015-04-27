<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;

class Page {

	protected $id;
	protected $title;
	protected $controlgroups = [];

	public function __construct($id, $title) {
		$this->id    = $id;
		$this->title = $title;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function addControlgroup(Controlgroup $controlgroup) {
		$this->controlgroups[] = $controlgroup;
	}

	public function getControlgroups() {
		return $this->controlgroups;
	}

}
