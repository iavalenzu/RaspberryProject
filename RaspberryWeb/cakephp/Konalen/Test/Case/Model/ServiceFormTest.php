<?php
App::uses('ServiceForm', 'Model');

/**
 * ServiceForm Test Case
 *
 */
class ServiceFormTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_form',
		'app.service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceForm = ClassRegistry::init('ServiceForm');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceForm);

		parent::tearDown();
	}

}
