<?php
App::uses('FormsController', 'Controller');

/**
 * ServicesController Test Case
 *
 */
class FormsControllerTest extends ControllerTestCase {
    
    public $fixtures = array('app.partner', 'app.service');

    public function testLogin(){
        
        //$result = $this->doCurlRequest('http://konalen.dev/forms/login');
        //debug($result);
        
        //$this->setExpectedException('BadRequestException');        
/*
        $this->testAction('/forms/login', array(
            'method' => 'GET',
            'return' => 'contents'
            
        ));

        
        debug($this->contents);
        
        //$this->assertRegExp('/<html/', $this->contents);        
        */
    $data = array(
            'FormId' => '',
            'ServiceId' => '2',
            'TransactionId' => 'trx_ca4218f6544874ca0b045d50493dc314aa122a303ca9f05873a9b3db6ff3b505',
            'CheckSum' => '24978a8399c747c264f6baa1f79e25d1696babfe6f3b40f3498942dfd76a4883',
            'CheckSumKey' => 'eyJkYXRhIjoie1wic2VhbGVkZGF0YVwiOlwiNmRjNmYzZWJmMjY5YzU2ODU4ODVmMzlmOGZiNWEzMzNmMjI2ODhlMjYyYzIyMWNlOTY4N2JiYzMxMTVjZjIxY2QwOGMzMTNlNjk5ZmM2MGI1MGNhNjg1OTQxNTRmMmY4NjQzNTVhNmRkYWYyMzFjMjA0ODZmNTM2NTUwOGY3NDM0YTU2MzAyOTAxZGY5YjFlMGEwZTQwOGI0M2RjNDI0NDE3YmMzOGEzOWI2Y2RmZjQ5NDRkMWVkY2Y0ZGNkMzM0XCIsXCJlbnZrZXlcIjpcImJiMDViYWVkYWMwNDlhOTc0NGMyZmUzOTViZjU1Y2FmYTRmYzMzYjZlMzlkOWRjODNmZjg2NGUzMzQwMzk4OWU5OTgyMzAzNjdmMWM2NzNlOGQxY2NhMTNjYjhkZWYwNTk3ZGIzNDJiNDQ4NTg1ODljMTI4Y2IzNGM5NzE5Y2IwNzc1ZDljMzY4MmMzMjNkYWQ5Njk2MGI5MjNkNDUyOTcwMzIxNzVlOGZmZjBkMWUyNDBmNDQwNTJkNTZhNzg3MmNmODAxZTMwMDhiOTZjNGRhNjQ4MmQwMDY3OTI3M2MzM2UyY2U4Nzk5OGU5OWY0NzIyZjE2MjI0YzM4MDhmMGEzZTg5Zjk0MDM0MmY2M2U0ZjRlZTBhNjVjNjIwZWEyNDM0YmY0ODk2ZTU0ZWVhNzc4YzFiZmYyZmRkNjYzZGM0MmNkNTk4ZGZhNmQ4MTRmMTQwOTUwNzM2MzNmMjY4N2VkMDg1ODQ1YmMyOGMzNjkxYjhhOWU0MTc5NmY0ODM5OTZkMzAxYWM0YTkzYzgxNTU0MWY0MGQ0MzA3MTc4NTRiNzZjOTU3YjMxNjYxMjUxMjc3MzI5NGRmNzk5NGMxYzg2MjU3MmNkYmQyNzg0ZmYyYjg3MGUyYTM1YzA2ZDU2OWZiY2Y1NjM3M2NlNTQ1NWZmMjUxZTUzNDZiNDFhNzQ5XCJ9Iiwic2lnbmF0dXJlIjoiOTllMDFhY2NjNzM1MWY3YTRkNTBhMzQ1YWFhZWU5NjBjMWUwMjEyYjQ1MjYyYWViMzE2YzEyOTI1OGMxODAxZWZiYjUxNGQwOWQ1MjRiYmE2YjgyNDIzNjdlYjBlZjYxYjU1ZDczZjA4YjEwYjg0MzU2MWFlZDNkNmQ5M2ExYWU0NGZhMTZiMDNkOTNlZGVjYTE2ZmZmZjE1NjYyYjI3MzIwN2NjZDRkZGJjMDM1Nzg0NWRjNzZhOThkODA0NDkyMGJmMDkxMjdlNWUxMDZmOGU5ZWQzMmZjYWExNzNmZjhlOWJkZTYyYWE2YTk5NmVkOGVhZmJjMzc2YjM1M2FjY2MxN2IyMWNjYTA0Yzk1Zjg5YmI2NzZlYWU2ZGMzZTk2NmU3MjBmMTE5MjUyMWQ4MTUyMTA5OTM3YjU0YzllZGJhMTUxZTY1MGU5MTU4MzcxMzRhNzViY2YzMDFmNzFjM2RkZjA3ZDVhYzlhNzUyZmY3M2RkMjEzN2ViMTljZmRmMzdjY2RlYjczOTU4N2FkN2Q4NDEzZDliYmUyNTFlODE5NTRhMDQ2MmFiYzc4MzhkN2M3NmVkMTQ2MTY0ZjY2MWVhYjBkNzFmMzdkZTdmYTJmOGU3ZjIyMjZiMzlmN2M1NDBiZTdhYjU5ODcwMzhkMDFjZjNjZjNiMWU5NzMyZTQifQ%3D%3D'
    );

    $this->testAction('/forms/login?' . http_build_query($data), array('method' => 'get'));        
        
    debug($this->contents);
        
        
        
    }
    
    
    
public function doCurlRequest($url, $get = array(), $post = array(), $headers = array()){
        

        if(!empty($post)){
            $post = http_build_query($post);
        }

        if(!empty($get)){
            $url .= "?" . http_build_query($get);
        }
        
        $options = array (
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle compressed
            CURLOPT_USERAGENT => "", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => empty($post) ? false : true
        );      

        $ch = curl_init ( $url );
        curl_setopt_array ( $ch, $options );
        $content = curl_exec ( $ch );
        $errno = curl_errno ( $ch );
        $error = curl_error ( $ch );
        $info = curl_getinfo ( $ch );
        
        return array(
            'errno' => $errno,
            'error' => $error,
            'info' => $info,
            'content' => $content
        );
        
        
    }    
        
    
/**
 * Fixtures
 *
 * @var array
 */


}
