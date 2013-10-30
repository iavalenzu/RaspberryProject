<?php

App::import('Lib', 'ResponseStatus');

class Utilities {
    
    public function getHeader($name = null, $require = true){
        
        $headers = apache_request_headers();
        
        if(isset($headers[$name]))
            return $headers[$name];

        if($require)
            return null;
        
        return null;
        
    }
    
    public function getRawPostData($require = true) {
        
        $output = null;
        $raw_data = file_get_contents('php://input');
        
        $content_type = env('CONTENT_TYPE');
        
        switch ($content_type) {
            case "application/json":
                $output = json_decode($raw_data, true);
                break;
            case "application/x-www-form-urlencoded;charset=UTF-8":
                parse_str($raw_data, $output);
                break;

            default:
                //Por defecto se considera como si las variables vinieran en texto plano
                parse_str($raw_data, $output);
                break;
        }
        
        if($require && empty($output))
            throw new BadRequestException(ResponseStatus::$missing_data);
        
        return $output;
        
    }
    
    public function exists($values = array(), $name = null, $require = true, $empty = false, $default = false){

        if(empty($values) || empty($name))
            throw new BadRequestException();
            
        if(isset($values[$name])){

            $value = trim($values[$name]);
            
            if(!$empty && empty($value)){
                //Si el valor es vacio y no es posible que sea vacio lanzamos una excepcion
                throw new BadRequestException(ResponseStatus::$missing_parameters);
            }else if($default){
                //Si esta permitido que sea vacio y esta definido el dafault, lo retornamos
                return $default;
            }
            
            return $value;
        }

        //Si en este punto no hemos retornado y el valor es requerido retornamos una excepcion
        if($require){
            throw new BadRequestException(ResponseStatus::$missing_parameters);
        }
        
        return null;
        
    }
    
    public function getAuthorizationKey() {
        
        $authorization = Utilities::getHeader('Authorization', true);
        
        if(empty($authorization))
            return null;
        
        $matches = array();
        
        if(!preg_match('/key=([a-zA-Z0-9_]+)/i', $authorization, $matches)){
            return null;
        }
        
        return isset($matches[1]) ? $matches[1] : null;

    }
    
    
    /**
   * Get the IP the client is using, or says they are using.
   *
   * @param boolean $safe Use safe = false when you think the user might manipulate their HTTP_CLIENT_IP
   *   header. Setting $safe = false will will also look at HTTP_X_FORWARDED_FOR
   * @return string The client IP.
   */
      public function clientIp($safe = true) {
          
          if (!$safe && env('HTTP_X_FORWARDED_FOR')) {
              $ipaddr = preg_replace('/(?:,.*)/', '', env('HTTP_X_FORWARDED_FOR'));
          } else {
              if (env('HTTP_CLIENT_IP')) {
                  $ipaddr = env('HTTP_CLIENT_IP');
              } else {
                  $ipaddr = env('REMOTE_ADDR');
              }
          }
  
          if (env('HTTP_CLIENTADDRESS')) {
              $tmpipaddr = env('HTTP_CLIENTADDRESS');
  
              if (!empty($tmpipaddr)) {
                  $ipaddr = preg_replace('/(?:,.*)/', '', $tmpipaddr);
              }
          }
          return trim($ipaddr);
      }    

      public function clientUserAgent() {
          
          $user_agent = '';
          
          if(env('HTTP_USER_AGENT')){
              $user_agent = env('HTTP_USER_AGENT');
              $user_agent = trim($user_agent);
          }
          
          return $user_agent;
          
     }    
      
     
    public function getRandomString($min = 20, $max = false, $source = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"){

        if($max)
            $length = mt_rand($min, $max);
        else
            $length = $min;
        
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $source[mt_rand(0, strlen($source)-1)];
        }
        
        return $randomString;
        
        
    } 
      
    /*Agrega un checksum al codigo generado para luego poder comparar la integridad del codigo y identificar si se envian codigos incorrectos*/
    
    public function createCode($min = 50, $max = false, $separator = '_', $base = 16) {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $parts = preg_split("/$separator/", $characters);
        
        if(count($parts) == 2){
            $characters = $parts[0] . $parts[1];
        }
        
        $randomString = Utilities::getRandomString($min, $max, $characters);
        
        $crc = crc32($randomString);
        $base_crc = base_convert($crc, 10, $base);
        
        return $randomString . $separator . $base_crc;
        
    }

    public function checkCode($code = null, $separator = '_', $base = 16) {

        if(empty($code))
            return false;
        
        //Buscamos la primera aparicion de la letra 'd'
        $randomString = strstr($code, $separator, true);
        
        $crc = crc32($randomString);
        $crc = base_convert($crc, 10, $base);
        $randomString = $randomString . $separator . $crc;
        
        return strcmp($code, $randomString) == 0;
        
    }
    
    public function getCaptchaHtml(){
        
        $public_key = Configure::read('ReCaptchaPublicKey');
        return "<script type='text/javascript' src='http://www.google.com/recaptcha/api/challenge?k=$public_key'> </script> <noscript> <iframe src='http://www.google.com/recaptcha/api/noscript?k=$public_key' height='300' width='500' frameborder='0'></iframe><br> <textarea name='recaptcha_challenge_field' rows='3' cols='40'> </textarea> <input type='hidden' name='recaptcha_response_field' value='manual_challenge'> </noscript>";
        
    }

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
    
    public function captchaIsCorrect($recaptcha_challenge_field = null, $recaptcha_response_field = null){

        if(empty($recaptcha_challenge_field) || empty($recaptcha_response_field))
            return false;

        $url = Configure::read('ReCaptchaUrlVerify');
        
        $data = array(
            'privatekey' => Configure::read('ReCaptchaPrivateKey'),
            'remoteip' => '',
            'challenge' => $recaptcha_challenge_field,
            'response' => $recaptcha_response_field
        );
 
        $response = doCurlRequest($url, $data);

        if(is_null($response))
            return false;

        if($response['errno'])
            return false;
        
        $content = explode("\n", $response['content']);
        
        if(empty($content))
            return false;
        
        return trim($content[0]) == 'true';
        
    }    
    
}

?>
