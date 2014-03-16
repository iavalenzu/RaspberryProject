<?php
App::uses('ConnectionNotification', 'Model');

/**
 * ConnectionNotification Test Case
 *
 */
class ConnectionNotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.connection_notification',
		'app.notification',
		'app.connection'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ConnectionNotification = ClassRegistry::init('ConnectionNotification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ConnectionNotification);

		parent::tearDown();
	}

}
