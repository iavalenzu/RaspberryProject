<?php

App::import('Lib', 'Utilities');

class UtilitiesTest extends CakeTestCase {
    
    public function setUp() {

    }

    public function testExists() {

        $data = array(
            'param' => 'value',
            'param2' => ''
        );
        
        $value = Utilities::exists($data, 'param', true, false, false);
        $this->assertEquals('value', $value);
        
        $value = Utilities::exists($data, 'param2', true, true, false);
        $this->assertEquals('', $value);

        $value = Utilities::exists($data, 'param2', true, true, 'default');
        $this->assertEquals('default', $value);
        
        $this->expectException('BadRequestException');
        $value = Utilities::exists($data, 'param1', true, false, false);
        $value = Utilities::exists($data, 'param2', true, false, false);

    }
    
    public function testCreateCode(){

        $code = Utilities::createCode(5,7);
        
        $check1 = Utilities::checkCode($code);
        $this->assertEquals(true, $check1);

        $check2 = Utilities::checkCode($code.'+');
        $this->assertEquals(false, $check2);
        
    }
    
    public function testRandomString(){
        
        $rand_string =  Utilities::getRandomString(40);
        
        debug($rand_string);
        
    }
   
    
}

?>
