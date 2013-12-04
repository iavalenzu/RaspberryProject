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
class SecurePacketSender {
    
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

        $sealeddata = "";
        $envkeys = array();
        
        if(!openssl_seal($plaindata_serialized, $sealeddata, $envkeys, array($recipientpublickeyid))){
            return false;
        }
        
        $encryptdata = array(
            'sealeddata' => bin2hex($sealeddata),
            'envkey' => bin2hex($envkeys[0])
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

        $signature = "";
        
        // compute signature
        if(!openssl_sign($encryptdata_encoded, $signature, $senderprivatekeyid, OPENSSL_ALGO_SHA1)){
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
        
        unset($this->recipientPublicKey);
        unset($this->senderPrivateKey);
        
        return base64_encode($signeddata_encoded);
        
    }    
}
