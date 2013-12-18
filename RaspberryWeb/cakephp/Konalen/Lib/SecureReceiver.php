<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecurePacket
 *
 * @author ivalenzu
 */
class SecureReceiver {
    
    /*Llave publica del que envia el mensaje*/
    var $senderPublicKey = null;

    /*Llave privada del receptor del mensaje*/
    var $recipientPrivateKey = null;
    
    
    public function setSenderPublicKey($public_key = null){
        $this->senderPublicKey = $public_key;
    }
    

    public function setRecipientPrivateKey($private_key = null){
        $this->recipientPrivateKey = $private_key;
    }

     function getRSAKeyPair($digest = "sha512", $bits = 2048){
        
        $config = array(
            "digest_alg" => $digest,
            "private_key_bits" => $bits,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        // Create the private and public key
        $res = openssl_pkey_new($config);

        if(!$res)
            return array();
        
        // Extract the private key from $res to $privKey
        if(!openssl_pkey_export($res, $privKey))
            return array();
            
        // Extract the public key from $res to $pubKey
        $details = openssl_pkey_get_details($res);

        if(!$details)
            return array();

        if(!isset($details["key"]))
            return array();
            
        $pubKey = $details["key"];   
        
        return array(
            'PublicKey' => $pubKey,
            'PrivateKey' => $privKey
        );
        
    }
    
   
    public function aes256_open($sealed_data, &$open_data, $env_key, $priv_key_id){
        
        $randomkey = false;
        
        if(!openssl_private_decrypt($env_key, &$randomkey , $priv_key_id, OPENSSL_PKCS1_PADDING) || !$randomkey){
            return false;
        }
        
        $open_data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $randomkey, $sealed_data, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));
        
        return true;
    }    
    
    public function decrypt($encryptdata = null){
        
        if(empty($encryptdata) || empty($this->recipientPrivateKey) || empty($this->senderPublicKey)){
            return false;
        }
        
        $encryptdata_b64_decoded = base64_decode($encryptdata);
        
        if(empty($encryptdata_b64_decoded)){
            return false;
        }
        
        $signeddata_json_decode = json_decode($encryptdata_b64_decoded, true);
        
        if(empty($signeddata_json_decode)){
            return false;
        }
        
        if(!isset($signeddata_json_decode['data']) || !isset($signeddata_json_decode['signature'])){
            return false;
        }

        $encryptdata = $signeddata_json_decode['data'];
        $signature = pack("H*", $signeddata_json_decode['signature']);
        
        if(empty($encryptdata) || empty($signature)){
            return false;
        }

        $senderpublickeyid = openssl_get_publickey($this->senderPublicKey);
        
        if(empty($senderpublickeyid)){
            return false;
        }
        
        if(!openssl_verify($encryptdata, $signature, $senderpublickeyid)){
            return false;
        }
        
        $encryptdata_decoded = json_decode($encryptdata, true);

        if(empty($encryptdata_decoded)){
            return false;
        }
        
        if(!isset($encryptdata_decoded['sealeddata']) || !isset($encryptdata_decoded['envkey'])){
            return false;
        }
        
        $sealeddata = pack("H*", $encryptdata_decoded['sealeddata']);
        $envkey = pack("H*", $encryptdata_decoded['envkey']);

        if(empty($sealeddata) || empty($envkey)){
            return false;
        }
        
        //Se obtiene la llave privada del receptor del mensaje
        $recipientprivatekeyid = openssl_get_privatekey($this->recipientPrivateKey);
        
        if(empty($recipientprivatekeyid)){
            return false;
        }
        
        if(!SecureReceiver::aes256_open($sealeddata, $opendata, $envkey, $recipientprivatekeyid)){
            return false;
        }
        
        openssl_free_key($senderpublickeyid);        
        openssl_free_key($recipientprivatekeyid);            
        
        unset($this->recipientPrivateKey);
        unset($this->senderPublicKey);
        
        return unserialize($opendata);        

    }
    
    
}

?>