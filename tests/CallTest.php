<?php

use HelloFuture\Monitor\Call;
use HelloFuture\Monitor\Dashboard\Control;

require_once __DIR__ . '/../vendor/autoload.php';

class CallTest extends PHPUnit_Framework_TestCase {

	public function testCall() {
		$control = new Control('ExampleCall');
		$control->foo = 23;
		$result  = $control->run();

		$callClass = new ExampleCall;

		$this->assertSame(get_class($callClass), $result->request->class);
		$this->assertSame(23,                    $result->request->params->foo);
		$this->assertSame(1,                     count((array) $result->request->params));
		$this->assertSame($callClass->getType(), $result->response->type);
		$this->assertSame(42,                    $result->response->data->bar);
		$this->assertGreaterThanOrEqual(.06,     $result->response->duration);
	}

}

class ExampleCall extends Call {

	protected function execute() {
		usleep(65000);
		return ['bar' => 42];
	}

	public function getType() {
		return 'unittest.something';
	}

}
