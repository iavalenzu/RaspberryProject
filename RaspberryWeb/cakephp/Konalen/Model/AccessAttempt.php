<?php
App::uses('AppModel', 'Model');



/**
 * AccessAttempt Model
 * 
 * @package       Konalen.Model
 * @property AccessAttempt $AccessAttempt
 * @property IpAddressAccessAttempt $IpAddressAttempt
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 * 
 */
class AccessAttempt extends AppModel {

        /**
         * Display field
         *
         * @var string
         */
	public $displayField = '';

        /**
         *
         * @var array
         * 
         */
        
        public $belongsTo = array(
		'IpAddressAccessAttempt' => array(
			'className' => 'IpAddressAccessAttempt',
			'foreignKey' => 'ip_address',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
}
