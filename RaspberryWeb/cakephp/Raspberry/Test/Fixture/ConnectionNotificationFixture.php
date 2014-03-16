<?php
/**
 * ConnectionNotificationFixture
 *
 */
class ConnectionNotificationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'notification_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'connection_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_connection_notification_idx' => array('column' => 'connection_id', 'unique' => 0),
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
			'connection_id' => 1,
			'status' => 'Lorem ipsum dolor sit amet'
		),
	);

}
