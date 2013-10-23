<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');


/**
 * Partner Model
 *
 * @property Service $Service
 * @property UserPartner $UserPartner
 */
class AccessAttempt extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';

        public function add($secret_key = ''){

            $data = array(
                'AccessAttempt' => array(
                    'user_agent' => Utilities::clientUserAgent(),
                    'ip_address' => Utilities::clientIp(),
                    'failed_key' => $secret_key
                )
            );

            return $this->save($data);
        }
        
        
}
