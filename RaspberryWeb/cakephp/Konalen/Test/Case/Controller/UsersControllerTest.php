<?php
App::uses('UsersController', 'Controller');

require_once 'MyControllerTestCase.php';


/**
 * UsersController Test Case
 *
 */
class UsersControllerTest extends MyControllerTestCase {

    
/**
 * Fixtures
 *
 * @var array
 */

        public function testLogin(){

            $data = json_encode(array(
                'email' => 'iavalenzu@gmail.com', 
                'password' => 'holass', 
                'user_agent' => 'agent', 
                'ip_address' => '1.0.0.0',
                'recaptcha_challenge_field' => '03AHJ_Vut6xlfJnv7fpEdapgnMcZIA4-G1Wa9U3VJL_PeuYl4D3VXltpF-NksayPupWPRTGY2VjRlUki3VR7LtD8FzavvcubTIrD9XDzq8upcBXbT9-rR76NDQFAPS4cZYhVlnAL8vSC89AMr5hvIWqOVnlhmB1qa81tSorp8xB5oFipDM8knBW2w',
		'recaptcha_response_field' => 'ecenax senior'
            ));
            
            $headers = array(
                "Authorization:key=03nh5IvWhvz04OkSZLJ21S0LBLUEFUpbSY2gHoJE9aaugahT07NvY6JoziB6f0d6i476l5'",
                "Content-Type:application/json"
            );
            
            $result = $this->myTestAction("http://localhost/sandbox/cakephp/Konalen/users/login.json", $data, $headers);

            debug($result);
            
            
            
        }

        
        public function testRegister(){
            
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
