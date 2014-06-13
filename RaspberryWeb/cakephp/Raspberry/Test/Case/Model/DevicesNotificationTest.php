<?php
App::uses('DevicesNotification', 'Model');

/**
 * DevicesNotification Test Case
 *
 */
class DevicesNotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.devices_notification',
		'app.notification',
		'app.response',
		'app.devices_notifications',
		'app.device',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DevicesNotification = ClassRegistry::init('DevicesNotification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DevicesNotification);

		parent::tearDown();
	}

}
