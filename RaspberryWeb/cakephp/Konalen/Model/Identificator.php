<?php
App::uses('AppModel', 'Model');
/**
 * Identificator Model
 *
 * @property Identity $Identity
 */
class Identificator extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Identity' => array(
			'className' => 'Identity',
			'foreignKey' => 'identificator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
