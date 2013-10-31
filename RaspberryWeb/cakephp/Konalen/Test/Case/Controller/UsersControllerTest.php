<?php
App::uses('UsersController', 'Controller');
App::import('Lib', 'Utilities');

require_once 'MyControllerTestCase.php';


/**
 * UsersController Test Case
 *
 */
class UsersControllerTest extends MyControllerTestCase {

    
    public $headers = array(
        "Authorization:key=szR4ALOSZuDQYgjCgntvDcAP1LO72fBJlKBZt5IICwHuSGkiNA_29243146",
        "Content-Type:application/json"
    );

    
    
/**
 * Fixtures
 *
 * @var array
 */

    
        public function testRenewSession(){
            
            $data = json_encode(array(
                'session_id' => 'DVRPwLDw3WXA5ZHTXZK7M8zCvHl6lcmgwdfjXsPwI3bPugImd1'
            ));
            
            $result = $this->myTestAction("http://localhost/sandbox/cakephp/Konalen/users/renewsession.json", $data, $this->headers);

            debug($result);
            
        }

        public function testChangePass(){
            
            $data = json_encode(array(
                'session_id' => 'LCTrkK8oxeCG2MrHAdiqcbQFjnNsPhtyXfevIDHKuLK2Q3w4kY', 
                'new_password' => 'holasssss', 
            ));
            
            $result = $this->myTestAction("http://localhost/sandbox/cakephp/Konalen/users/changepassword.json", $data, $this->headers);

            debug($result);
            
        }
        
        public function testLogin(){

            $data = json_encode(array(
                'email' => 'iavalenzu@gmail.com', 
                'password' => 'holasssss', 
                'user_agent' => 'agent', 
                'ip_address' => '1.0.0.0',
                'recaptcha_challenge_field' => '03AHJ_Vut6xlfJnv7fpEdapgnMcZIA4-G1Wa9U3VJL_PeuYl4D3VXltpF-NksayPupWPRTGY2VjRlUki3VR7LtD8FzavvcubTIrD9XDzq8upcBXbT9-rR76NDQFAPS4cZYhVlnAL8vSC89AMr5hvIWqOVnlhmB1qa81tSorp8xB5oFipDM8knBW2w',
		'recaptcha_response_field' => 'ecenax senior'
            ));
            
            $result = $this->myTestAction("http://localhost/sandbox/cakephp/Konalen/users/login.json", $data, $this->headers);

            debug($result);
            
        }

        public function testRegister(){
            
            $data = json_encode(array(
                'email' => 'iavalenzu@gmail.com', 
                'password' => 'holas',
                'data' => array(
                    'name' => 'Pedrito',
                    'address' => '',
                    'age' => 27
                )
            ));
            
            $result = $this->myTestAction("http://localhost/sandbox/cakephp/Konalen/users/register.json", $data, $this->headers);

            debug($result);            
            
        }        
        
/**
 * testIndex method
 *
 * @return void
 */
/*
        public function testIndex() {
	}
*/
/**
 * testView method
 *
 * @return void
 */
/*	public function testView() {
	}
*/
/**
 * testAdd method
 *
 * @return void
 */
/*	public function testAdd() {
	}
*/
/**
 * testEdit method
 *
 * @return void
 */
/*	public function testEdit() {
	}
*/
/**
 * testDelete method
 *
 * @return void
 */
/*	public function testDelete() {
	}
*/
/**
 * testAdminIndex method
 *
 * @return void
 */
/*	public function testAdminIndex() {
	}
*/
/**
 * testAdminView method
 *
 * @return void
 */
/*	public function testAdminView() {
	}
*/
/**
 * testAdminAdd method
 *
 * @return void
 */
/*	public function testAdminAdd() {
	}
*/
/**
 * testAdminEdit method
 *
 * @return void
 */
/*	public function testAdminEdit() {
	}
*/
/**
 * testAdminDelete method
 *
 * @return void
 */
/*	public function testAdminDelete() {
	}
*/
}
