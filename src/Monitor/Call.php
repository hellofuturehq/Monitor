<?php

namespace HelloFuture\Monitor;

abstract class Call {

	protected $params;

	public function __construct($params = array()) {
		$this->params = (object) $params;
	}

	public function __invoke() {
		$now      = microtime(true);
		$data     = (object) $this->execute();
		$duration = microtime(true) - $now;

		return (object) [
			'request' => (object) [
				'class'  => get_called_class(),
				'params' => $this->params
			],
			'response' => (object) [
				'type'     => $this->getType(),
				'data'     => $data,
				'duration' => $duration,
			]
		];
	}

	abstract protected function execute();

	abstract protected function getType();

}
