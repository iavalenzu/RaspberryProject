<?php

App::import('Lib', 'ResponseStatus');

/**
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 * @package Konalen.Lib

 */


class Utilities {

    /**
     * 
     * @param string $name
     * @param boolean $require
     * @return string
     */
    
    public function getHeader($name = null){
        
        $headers = apache_request_headers();
        
        if(isset($headers[$name])){
            return $headers[$name];
        }

        return "";
        
    }
    
    public function getPost($name = null){
        
        if(isset($_POST[$name])){
            return $_POST[$name];
        }

        return "";
    }

    public function getGet($name = null){
        
        if(isset($_GET[$name])){
            return $_GET[$name];
        }

        return "";
    }
    
    
    
    /**
     * 
     * @param boolean $require
     * @return string|array
     * @throws BadRequestException
     */
    
    public function getRawPostData($require = true) {
        
        $output = "";
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
    
    /**
     * 
     * @param array $values
     * @param string $name
     * @param boolean $require
     * @param boolean $empty
     * @param mixed $default
     * @return mixed
     * @throws BadRequestException
     */
    
    public function exists($values = array(), $name = null, $require = true, $empty = false, $default = false){

        if(empty($values) || empty($name))
            throw new BadRequestException();
            
        if(isset($values[$name])){

            //Todo ver que pasa cuando el valor es un arreglo
            $value = $values[$name];
            
            if(empty($value)){
                
                //Si el valor es vacio y no es posible que sea vacio lanzamos una excepcion
                if(!$empty)
                    throw new BadRequestException(ResponseStatus::$missing_parameters);

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
    
    /**
     * Busca el header Authorization y obtiene la llave de acceso que viene en él.
     * 
     * @return string
     */
    
    public function getCredentials() {
        
        $authorization = Utilities::getHeader('Authorization');

        if(empty($authorization)){
            return null;
        }            
        
        $matches = array();

        if(!preg_match('/([a-zA-Z0-9]+)\s+([a-zA-Z0-9]+)/i', $authorization, $matches)){
            return null;
        }

        if(empty($matches) || !isset($matches[1]) || !isset($matches[2])){
            return null;
        }

        $name = $matches[1];
        $key = $matches[2];
            
        $credentials = new stdClass();
        $credentials->name = $name;
        $credentials->key = $key;

        return $credentials;
            
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

      /**
       * 
       * @return string El user agent del partner.
        */
      
      public function clientUserAgent() {
          
          $user_agent = '';
          
          if(env('HTTP_USER_AGENT')){
              $user_agent = env('HTTP_USER_AGENT');
              $user_agent = trim($user_agent);
          }
          
          return $user_agent;
          
     }    
      
     /**
      * Genera una cadena de caracteres aleatorios. 
      *
      * Si el maximo no está definido, se crea una cadena de largo igual al mínimo. 
      * 
      * @param integer $min El largo minimo de la cadena a generar.
      * @param integer|boolean $max El largo maximo de la cadena a generar.
      * @param string $source La cadena de caracteres utilizada como fuente para seleccionar caracteres al azar.
      * @return string La cadena aleatoria.
      */
     
    public function getRandomCode($numBits = 1024){

        $numBytes = $numBits / 8;
        
        $crypto_strong = false;
        
        $randBytes = openssl_random_pseudo_bytes($numBytes, $crypto_strong);

        if(!$crypto_strong){
            return false;
        }

        return bin2hex($randBytes);
        
    } 

    /**
     * Transforma en mayusculas caracteres elegidos al azar de la cadena.
     * 
     * @param string $source
     * @return string
     */
    
    public function randUpperCase($source = false){
        
        $out = "";
        for($i=0; $i<strlen($source); $i++)
            $out .=  mt_rand(0,1) ? strtoupper($source[$i]) : $source[$i];
        
        return $out;
        
    }
    
    
    /**
     * Genera un codigo aleatorio que incluye una cadena de comprobacion.
     * Agrega un checksum al codigo generado para luego poder comparar la integridad del codigo y identificar si se envian codigos incorrectos
     * 
     * @param integer $min El largo minimo de la cadena.
     * @param integer|boolean $max El largo maximo de la cadena, en caso de ser false se genera una cadena de largo $min
     * @param string $separator La subcadena que separa la cadena aleatoria y el codigo de comprobacion.
     * @param integer $base La base numérica a la cual se convierte el codigo de comprobacion.
     * @return string
     */
    /*
    public function createCode($min = 50, $max = false, $separator = 'i', $base = 28) {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $parts = preg_split("/$separator/", $characters);
        
        if(count($parts) == 2){
            $characters = $parts[0] . $parts[1];
        }
        
        $randomString = Utilities::getRandomString($min, $max, $characters);
        
        $check = base_convert(crc32($randomString), 10, $base);
        
        return $randomString . $separator . Utilities::randUpperCase($check);
        
    }
    */
    /**
     * 
     * @param string $code
     * @param string $separator
     * @param integer $base
     * @return boolean
     */
    /*
    public function checkCode($code = null, $separator = 'i', $base = 28) {

        if(empty($code))
            return false;

        //Buscamos la primera aparicion del separador
        $parts = explode($separator, $code, 2);
        
        if(count($parts) < 2)
            return false;
        
        $randomString = $parts[0];
        $check = $parts[1];
        
        $crc = base_convert(crc32($randomString), 10, $base);
        
        return strcasecmp($crc, $check) == 0;
        
    }
    */

    /**
     * 
     * @param string $url
     * @param array $get
     * @param array $post
     * @param array $headers
     * @return array
     */
    
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
     * 
     * @param integer $min
     * @param integer $max
     * @return integer
     * @see http://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
     */
    
    
    function crypto_rand_secure($min, $max) {
        
        $range = $max - $min;
        if ($range == 0){ return false; }
        
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $s)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        
        return $min + $rnd;
        
    }    
    
    public function hash_array($data = array()){
        
        $imploded_data = implode(',', $data);

        return sha1($imploded_data);
        
    }
    
    
}

?>
