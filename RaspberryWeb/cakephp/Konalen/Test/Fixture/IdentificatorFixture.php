<?php
/**
 * IdentificatorFixture
 *
 */
class IdentificatorFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 225, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'comment' => 'Corresponde al email, rut, phone... Cualquier campo que identifique al usuario', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-12-11 11:40:48',
			'modified' => '2013-12-11 11:40:48'
		),
	);

}
