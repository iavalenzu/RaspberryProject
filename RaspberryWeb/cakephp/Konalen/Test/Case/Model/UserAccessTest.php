<?php
App::uses('UserAccess', 'Model');

/**
 * UserAccess Test Case
 *
 */
class UserAccessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_access',
		'app.account',
		'app.user',
		'app.service',
		'app.partner',
		'app.partner_access',
		'app.service_form'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserAccess = ClassRegistry::init('UserAccess');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserAccess);

		parent::tearDown();
	}

}
