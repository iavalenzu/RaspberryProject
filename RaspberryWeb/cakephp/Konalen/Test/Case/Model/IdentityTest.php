<?php
App::uses('Identity', 'Model');

/**
 * Identity Test Case
 *
 */
class IdentityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.identity',
		'app.user',
		'app.identificator'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Identity = ClassRegistry::init('Identity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Identity);

		parent::tearDown();
	}

}
