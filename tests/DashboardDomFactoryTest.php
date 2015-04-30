<?php

require_once __DIR__ . '/../vendor/autoload.php';

class DashboardTest extends PHPUnit_Framework_TestCase {

	public function testParse() {
		$file      = __DIR__ . '/data/example1.xml';
		$factory   = new HelloFuture\Monitor\Dashboard\DashboardDOMFactory($file);

		$dashboard = $factory->create();
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Dashboard', $dashboard);

		$pages = $dashboard->getPages();
		$this->assertEquals(1, count($pages));

		$page = $pages[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Page', $page);
		$this->assertEquals('page-1', $page->getId());
		$this->assertEquals('Dashboard Page 1', $page->getTitle());

		$cgroups = $page->getControlgroups();
		$this->assertEquals(2, count($cgroups));

		$cgroup = $cgroups[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Controlgroup', $cgroup);
		$this->assertEquals('controlgroup-1', $cgroup->getId());
		$this->assertEquals('Control Group 1', $cgroup->getTitle());

		$controls = $cgroup->getControls();
		$this->assertEquals(2, count($controls));

		$control = $controls[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Control', $control);
		$this->assertEquals('Example\Foo\Running', $control->getCall());

		$this->assertEquals((object) ['id' => '6174'], $control->getParams());
		$this->assertEquals('6174', $control->id);
		$this->assertTrue(isset($control->id));
		$this->assertFalse(isset($control->key));
	}

}
