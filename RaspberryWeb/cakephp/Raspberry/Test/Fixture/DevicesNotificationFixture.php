<?php
/**
 * DevicesNotificationFixture
 *
 */
class DevicesNotificationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'notification_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'device_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_connection_notification_idx' => array('column' => 'device_id', 'unique' => 0),
			'fk_connection_notification_2_idx' => array('column' => 'notification_id', 'unique' => 0)
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
			'id' => 1,
			'notification_id' => 1,
			'device_id' => 1,
			'status' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-13 02:09:31',
			'modified' => '2014-06-13 02:09:31'
		),
	);

}
