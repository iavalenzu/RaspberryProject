<?php
App::uses('Identificator', 'Model');

/**
 * Identificator Test Case
 *
 */
class IdentificatorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.identificator',
		'app.identity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Identificator = ClassRegistry::init('Identificator');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Identificator);

		parent::tearDown();
	}

}
