<?php
App::uses('PartnerAccess', 'Model');

/**
 * PartnerAccess Test Case
 *
 */
class PartnerAccessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.partner_access',
		'app.partner'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PartnerAccess = ClassRegistry::init('PartnerAccess');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PartnerAccess);

		parent::tearDown();
	}

}
