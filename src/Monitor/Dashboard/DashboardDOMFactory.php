<?php

namespace HelloFuture\Monitor\Dashboard;

use DOMDocument;
use DOMXpath;
use RunTimeException;

class DashboardDOMFactory {

	protected $xmlPath;

	public function __construct($xmlPath) {
		$this->xmlPath = $xmlPath;
	}

	public function create() {
		$this->doc = new DOMDocument();
		$this->doc->load($this->xmlPath);
		if (!$this->isValid()) {
			throw new RunTimeException('invalid config file ' . $this->xmlPath);
		}
		$dashboard = new Dashboard;
		$this->addPagesToDashboard($dashboard);
		return $dashboard;
	}

	protected function getRootNode() {
		return $this->doc->documentElement;
	}

	protected function isValid() {
		return $this->getRootNode()->nodeName == 'dashboard';
	}

	protected function addPagesToDashboard($dashboard) {
		$list  = $this->query('/dashboard/page');
		foreach($list as $childElement) {
			$id    = $childElement->getAttribute('id');
			$title = $this->query('./title', $childElement)->item(0)->firstChild->nodeValue;
			$page  = new Page($id, $title);
			$this->addControlgroupsToPage($page, $childElement);
			$dashboard->addPage($page);
		}
	}

	protected function addControlgroupsToPage($page, $domElement) {
		$list  = $this->query('controlgroup', $domElement);
		foreach($list as $childElement) {
			$id           = $childElement->getAttribute('id');
			$title        = $this->query('./title', $childElement)->item(0)->firstChild->nodeValue;
			$controlgroup = new Controlgroup($id, $title);
			$this->addControlsToControlgroup($controlgroup, $childElement);
			$page->addControlgroup($controlgroup);
		}
	}

	protected function addControlsToControlgroup($controlgroup, $domElement) {
		$list  = $this->query('control', $domElement);
		foreach($list as $childElement) {
			$type    = $childElement->getAttribute('type');
			$call    = $childElement->getAttribute('call');
			$control = new Control($type, $call);
			$controlgroup->addControl($control);
		}
	}

	protected function query($query, $contextNode = null) {
		$xpath = new DOMXpath($this->doc);
		return $xpath->query($query, $contextNode);
	}

}
