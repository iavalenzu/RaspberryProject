<?php
/**
 * IpAddressAccessAttemptFixture
 *
 */
class IpAddressAccessAttemptFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'ip_address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'access_attempts' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'blocked_until' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'ip_address', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'ip_address' => 'Lorem ipsum dolor sit amet',
			'access_attempts' => 1,
			'blocked_until' => '2013-12-11 11:42:43',
			'created' => '2013-12-11 11:42:43',
			'modified' => '2013-12-11 11:42:43'
		),
	);

}
