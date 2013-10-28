<?php

/**
 * PartnersController Test Case
 *
 */
class MyControllerTestCase extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
    
    public function myTestAction($url, $data, $headers, $post = true){
        
        $options = array (
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle compressed
            CURLOPT_USERAGENT => "test", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => $post
        );      
        
        $ch = curl_init ( $url );
        curl_setopt_array ( $ch, $options );
        $content = curl_exec ( $ch );
        $err = curl_errno ( $ch );
        $errmsg = curl_error ( $ch );
        $header = curl_getinfo ( $ch );
        $httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

        curl_close ( $ch );

        $response = array();
        $response ['httpcode'] = $httpCode;
        $response ['errno'] = $err;
        $response ['errmsg'] = $errmsg;
        $response ['content'] = $content;
        $response ['header'] = $header;
        
        return $response;        

        
    }
    
    

}
