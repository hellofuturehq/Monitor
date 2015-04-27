<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;

class Controlgroup {

	protected $id;
	protected $title;
	protected $controls = [];

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

	public function addControl(Control $control) {
		$this->controls[] = $control;
	}

	public function getControls() {
		return $this->controls;
	}

}
