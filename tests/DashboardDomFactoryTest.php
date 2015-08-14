<?php

require_once __DIR__ . '/../vendor/autoload.php';

class DashboardTest extends PHPUnit_Framework_TestCase {

	public function testParse() {
		$file      = __DIR__ . '/data/example1.xml';
		$factory   = new HelloFuture\Monitor\Dashboard\DashboardDOMFactory($file);

		$dashboard = $factory->create();
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Dashboard', $dashboard);

		$pages = $dashboard->getPages();
		$this->assertSame(1, count($pages));

		$page = $pages[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Page', $page);
		$this->assertSame('page-1', $page->getId());
		$this->assertSame('Dashboard Page 1', $page->getTitle());

		$cgroups = $page->getControlgroups();
		$this->assertSame(2, count($cgroups));

		$cgroup = $cgroups[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Controlgroup', $cgroup);
		$this->assertSame('controlgroup-1', $cgroup->getId());
		$this->assertSame('Control Group 1', $cgroup->getTitle());

		$controls = $cgroup->getControls();
		$this->assertSame(2, count($controls));

		$control = $controls[0];
		$this->assertInstanceOf('\HelloFuture\Monitor\Dashboard\Control', $control);
		$this->assertSame('Example\Foo\Running', $control->getCall());

		$this->assertEquals(['id' => '6174'], $control->getParams());
		$this->assertSame('6174', $control['id']);
		$this->assertTrue(isset($control['id']));
		$this->assertFalse(isset($control['unknownkey']));
	}

}
