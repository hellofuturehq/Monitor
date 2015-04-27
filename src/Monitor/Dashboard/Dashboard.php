<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;

class Dashboard {

	protected $pages = [];

	public function addPage(Page $page) {
		$this->pages[] = $page;
	}

	public function getPages() {
		return $this->pages;
	}

}
