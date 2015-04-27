<?php

require_once __DIR__. '/../vendor/autoload.php';

class DashboardTest extends PHPUnit_Framework_TestCase {

	public function testExistance() {

		$file = __DIR__ . '/data/example1.xml';
		$dashboard = new HelloFuture\Monitor\Dashboard\Dashboard($file);

		$this->assertInstanceOf('HelloFuture\\Monitor\\Dashboard\\Dashboard', $dashboard);

	}

	public function testValid() {

		$file = __DIR__ . '/data/example1.xml';
		$dashboard = new HelloFuture\Monitor\Dashboard\Dashboard($file);
		$this->assertTrue($dashboard->isValid());

	}

}
