<?php
App::uses('AppModel', 'Model');
/**
 * Identity Model
 *
 * @property User $User
 * @property Identificator $Identificator
 */
class Identity extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Identificator' => array(
			'className' => 'Identificator',
			'foreignKey' => 'identificator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
