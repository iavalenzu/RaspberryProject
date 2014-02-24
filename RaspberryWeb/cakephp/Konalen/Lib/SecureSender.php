<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecurePacketSender
 *
 * @author ivalenzu
 */
class SecureSender {
    
    /*Llave publica del receptor en este caso Konalen*/
    var $recipientPublicKey = null;

    /*Llave privada del emisor del mensaje*/
    var $senderPrivateKey = null;
    
    
    public function setRecipientPublicKey($public_key = null){
        $this->recipientPublicKey = $public_key;
    }
    
    public function setSenderPrivateKey($private_key = null){
        $this->senderPrivateKey = $private_key;
    }    

   
    /*Ya que no es posible ssl_seal con el cifrado AES256 se implementa esta opcion*/
    public function aes256_seal($data, &$sealed_data, &$env_key, $pub_key_id){
    
        $crypto_strong = false;
        
        /*Se genera la llave aleatoria*/
        $randomkey = openssl_random_pseudo_bytes( 32, $crypto_strong);
        
        if(!$crypto_strong){
            return false;
        }
        
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        
        /*Se encripta la data usando la llave aleatoria*/
        $sealed_data = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $randomkey, $data, MCRYPT_MODE_ECB, $iv);
        
        /*Se cifra la llave aleatoria usando la llave publica del receptor*/
        if(!openssl_public_encrypt($randomkey, $env_key , $pub_key_id, OPENSSL_PKCS1_PADDING)){
            return false;
        }
     
        return true;
    }    
    
        
    public function encrypt($plaindata = null){
        
        if(empty($plaindata) || empty($this->recipientPublicKey) || empty($this->senderPrivateKey)){
            return false;
        }
        
        $plaindata_serialized = serialize($plaindata);
        
        //Sella la informacion para solo el recipiente pueda leer el mensaje con su llave privada
        
        $recipientpublickeyid = openssl_get_publickey($this->recipientPublicKey);
        
        if(empty($recipientpublickeyid)){
            return false;
        }

        $sealeddata = false;
        $envkey = false;
        
        if(!SecureSender::aes256_seal($plaindata_serialized, $sealeddata, $envkey, $recipientpublickeyid) || !$sealeddata || !$envkey){
            return false;
        }
        
        $encryptdata = array(
            'sealeddata' => bin2hex($sealeddata),
            'envkey' => bin2hex($envkey)
        );
        
        $encryptdata_encoded = json_encode($encryptdata);

        if(empty($encryptdata_encoded)){
            return false;
        }
        
        //Firmamos el mensaje para asegurar que el emisor es quien lo envia.

        $senderprivatekeyid = openssl_get_privatekey($this->senderPrivateKey);
        
        if(empty($senderprivatekeyid)){
            return false;
        }

        $signature = false;
        
        // compute signature
        if(!openssl_sign($encryptdata_encoded, $signature, $senderprivatekeyid, OPENSSL_ALGO_SHA1) || !$signature){
            return false;
        }
        
        $signeddata = array(
            'data' => $encryptdata_encoded,
            'signature' => bin2hex($signature)
        );
        
        $signeddata_encoded = json_encode($signeddata);
        
        if(empty($signeddata_encoded)){
            return false;
        }
        
        return base64_encode($signeddata_encoded);
        
    }
    
    public function destroy(){
        
        openssl_free_key($recipientpublickeyid);        
        openssl_free_key($senderprivatekeyid);        
        
        unset($this->recipientPublicKey);
        unset($this->senderPrivateKey);
        
    }
    
    
}
