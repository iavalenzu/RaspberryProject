<?php

App::import('Lib', 'SecurePacket');
App::import('Lib', 'SecurePacketSender');
App::import('Lib', 'SecurePacketReceiver');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecurePacketTest
 *
 * @author ivalenzu
 */
class SecurePacketTest extends CakeTestCase{

    
   public function testRSAKeyPair(){
        
        
        //debug(Utilities::getRSAKeyPair());
        
        
    }
    
    public function testRandomPseudo(){
        
        
        //debug(Utilities::getRSAKeyPair());
        
        
        $recipientPublicKey =  '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtvIoJHV4R2oeDFgj1t/l
V3Xt8j9pBvRmF/zmSmRxbkCNpkMI5IAt8+/VOZplXgcPNMQ1G/PSZLfWZwCKTK0y
YLjF1Guj9uzxZNq7AEtxjKYmQzaLoFqasKdyPmkP/nYh5MnOslfdEoB4cm4X6NU/
quufb7lFX0aPbLY37NPrRQWyp7wpiHbSFubFFE4gWQA4+vo4tDsXSIyzC8137vLj
5K9w233IWOjqX3776SIaGXxumGwx6GxQIlruweouBqMdod/XUdnyJHZeNULBzafV
3Onz5OWegoY8C3qoz6LDUXSAhAxR7noxXesGBWQz1QoNqK/vNFh54sRUAKKpkyxZ
TQIDAQAB
-----END PUBLIC KEY-----';
        
        $recipientPrivateKey = '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC28igkdXhHah4M
WCPW3+VXde3yP2kG9GYX/OZKZHFuQI2mQwjkgC3z79U5mmVeBw80xDUb89Jkt9Zn
AIpMrTJguMXUa6P27PFk2rsAS3GMpiZDNougWpqwp3I+aQ/+diHkyc6yV90SgHhy
bhfo1T+q659vuUVfRo9stjfs0+tFBbKnvCmIdtIW5sUUTiBZADj6+ji0OxdIjLML
zXfu8uPkr3DbfchY6OpffvvpIhoZfG6YbDHobFAiWu7B6i4Gox2h39dR2fIkdl41
QsHNp9Xc6fPk5Z6ChjwLeqjPosNRdICEDFHuejFd6wYFZDPVCg2or+80WHnixFQA
oqmTLFlNAgMBAAECggEAcXaCmwoYDQKtnC5WHABEtxe2+dWGCAAwCZSaJ21gRGbY
81MEAuPUnEQU1GMDl2t9bNZ7sdholnrGCJ/3JlMMuZwfZf1UdeLCXDCkZixkQj0R
4gHEWzGWWxWe70It3z3ZC5J2FXoU7FKtYRsSzR7lG9aCzcH0WoDilyP0T3enpOg0
7IvHY9Dix8zF+DpqNdytPRgtPQbVa1o+QLdk4qHrWdhlbmddXRErwvcR7UqOCvIi
CmoMK7mlGf+b4cxUFOBbpYpWRj3TeOMXla8gnG3R966qx5nHH3u2G+DTMxZSTleQ
chfELoXiTnRYvrYrJtK0LssSSKRM4AleqBk9Yq0EKQKBgQDkhzk60TharCH/6oPC
Zwiv7oHIPSJLkaHIk/922TDr+PIYsabR+qT/tT9axrepmFPocrSwgRe9Jf1sUG8E
Sb0LtvgDfJfA9KfwyfZcE5mg9mhql2zo7YfNRQ7avgG8GF/fxOxGcfgFlBywY0O5
TJJeBn/Fm7H0BUL1W8yb0PP6wwKBgQDM8CyLrySGwV9x4Yv5MjQuTfN7AD9wcEpz
YvjirT0pt3C2IPd5v2gZ86GDAE0eba7Sh4qLbpMV8SMjR6v5uYuV57GMz1mi2olh
9saVCtJrvISE0QoEyzq8K8RnBFR+zEjshF+a/A+WZBJvw7dWAmc3TT3ZIZi+zLMy
hX8dkWF6rwKBgQDAW4I0m/8Pc2x6+W9Gp2uMivn7DlpbuY2wQ8L4ywB+3+EIICEH
Bi70fh+BzVqzCmE2e7bUCxVsRRn3ngyUU20o+y3v4WPrKwRhjd4syuK5ti9V6Xfm
6GkywzoprV3QccPhmuQ2t5/JMk6juio7QtTBCD9smg1EFVmzJT4ouc1j+QKBgGSn
YXmJn+r/dp08Jb9SxQYpCvjSelYDEM3zQkIyy+N9UUJilqmZNMvqON1afIYBYOfN
4mHxARS5xoRBY1nXo5MQpMd/34p4wxj2VzpEgmyfvoZtFPqdxk89P81I9yb/tqFT
spEwU4eNxvBVs+nubDthGItYUOkFKM4bev9OtA3JAoGBAKYmWNgJ/30uM92zTW+8
kgXnX2CGQlFhv6M7jNgzeTqAAFvh/CwcYmRWqvR68tOF8ToJ7lUpGaaR+z2l0lbp
oh1ejeit9z/Gj+1suMs36eAKviY/ITOm/e1d4fFCY7lBYIkPAu81whNiniumtViZ
JL5gAtTxTr8e+XOR1oA2bNcz
-----END PRIVATE KEY-----';
        
        
        
        $data = array(
            'msg' => "Este es un mensaje al azar!!!"
        );


        /*Simulo un envio de data*/

        $KonalenPrivateKey = Configure::read('KonalenPrivateKey');
        
        $sps = new SecurePacketSender();
        $sps->setRecipientPublicKey($recipientPublicKey);
        $sps->setSenderPrivateKey($KonalenPrivateKey);

        $sd = new SecurePacket();
        $sd->setData("Holas!!!!");
        
        $securedata = $sps->encrypt($sd);
        
        debug(strlen($securedata));
        debug($securedata);

        $KonalenPublicKey = Configure::read('KonalenPublicKey');
        
        $spr = new SecurePacketReceiver();
        $spr->setSenderPublicKey($KonalenPublicKey);
        $spr->setRecipientPrivateKey($recipientPrivateKey);
        
        $packet = $spr->decrypt($securedata);
        
        debug($packet->getData());
        
      
    }    
    
    
    
}
