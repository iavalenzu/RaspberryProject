<?php


class Konalen {

    public static $konalen_register_url = "http://localhost/sandbox/cakephp/Konalen/users/register.json";
    public static $konalen_secret_key = "szR4ALOSZuDQYgjCgntvDcAP1LO72fBJlKBZt5IICwHuSGkiNA_29243146";
    
 
    public function doCurlRequest($url, $data = array(), $headers = array(), $post = true){
        
        if(!is_array($data)) return null;
        
        if($data)
            $data = http_build_query($data);
        
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
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => $post
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
    
    public function register($email, $password, $data){
        
            $data = json_encode(array(
                'email' => $email, 
                'password' => $password,
                'data' => $data
            ));
              
            $headers = array(
                "Authorization:key=" . Konalen::$konalen_secret_key,
                "Content-Type:application/json"
            );

            $response = Konalen::doCurlRequest(Konalen::$konalen_register_url, $data, $headers);
            
            if($response['info']['http_code'] == 200){
                
                
            }
        
        
    }
    
    
    
    
    
}

?>
