<?php
App::uses('IpAddressAccessAttempt', 'Model');

/**
 * IpAddressAccessAttempt Test Case
 *
 */
class IpAddressAccessAttemptTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ip_address_access_attempt',
		'app.access_attempt'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IpAddressAccessAttempt = ClassRegistry::init('IpAddressAccessAttempt');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IpAddressAccessAttempt);

		parent::tearDown();
	}

}
