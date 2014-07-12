<?php
App::uses('Fifo', 'Model');

/**
 * Fifo Test Case
 *
 */
class FifoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fifo',
		'app.device',
		'app.user',
		'app.devices_notifications'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fifo = ClassRegistry::init('Fifo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fifo);

		parent::tearDown();
	}

}
