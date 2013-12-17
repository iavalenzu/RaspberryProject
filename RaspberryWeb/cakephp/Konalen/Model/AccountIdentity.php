<?php
App::uses('AppModel', 'Model');
/**
 * AccountIdentity Model
 *
 * @property AccountIdentity $AccountIdentity
 */
class AccountIdentity extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Identity' => array(
			'className' => 'Account',
			'foreignKey' => 'identity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
