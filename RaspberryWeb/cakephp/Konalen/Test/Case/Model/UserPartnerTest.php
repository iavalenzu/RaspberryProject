<?php
App::uses('UserPartner', 'Model');

/**
 * UserPartner Test Case
 *
 */
class UserPartnerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_partner',
		'app.user',
		'app.partner',
		'app.service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserPartner = ClassRegistry::init('UserPartner');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserPartner);

		parent::tearDown();
	}

}
