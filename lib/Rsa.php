<?php
/**
 * Created by IntelliJ IDEA.
 * User: yamei
 * Date: 2018/9/9
 * Time: 9:54
 */

class Rsa
{
    private static $PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDbyXU6cNOxIktF1dLkztVrVl3YXLfJ4DciCqlDFwRWMuu4nKvw
jgnycA2ngNWFQThz9xe1iUjWed2fyn1RXItOWE6NlrGLp7w81o+9EIK+7yCmdmx0
Ibpk0NiAJcNudoBgIOieyMvuab40sefEuluUMgNPkUV8SN0dqpddImcStwIDAQAB
AoGBAKYz3wFVhs/hhhiGTJeYTU2BHzBZVOZFNov4kezY//+LPDP7zg3360+5Kqor
Q8wj+OPAy94MtdbyiwSl5ERdfj1WnWcYcBT9t65CkLXcFBDG/bYxgGkpNBHUgMiW
aSxpXWCJk5XACZ4qKk6V4p3xF/bQ6AggmHpenxEM9JXztm5pAkEA9NmEXRdL7+so
82TonxjTNH9/i1HLASdc0ezd7GpO43/aXndX9V5Esy6C+OBzzv3HUzO4GUkyCauT
FadpFS2c0wJBAOXLwcftpQf85wSen8APTqt8mX1JUASl6+hdS9Q6diQdMnB1kUto
LRMO/YwKaUF/WIw62WS8SfZUvw8AWr3P9A0CQAIm50LqMYCqUHHTMTg0v6Z2eGiB
D4ezEN3Hdyvcw1S8iu7JnbxKV9A7WGtXja0EDfxtN/EA86+iEmjeT84f2IECQQDV
IyH/QApb2FSl0kK1rvz2zcDHleIkDYk7op0coYTGhlYsPL+gw2VbUgIVi+qIl4cX
udW9O28WjRAQ5/FCMMlZAkBO2Zf7zSpS1E9nuHxEljYrzrI+K+o5qqxfmtpUt8xJ
MveWyP/opVWBHklcB5/wzlmVXMFKrUOVPzN2Wzo35ZzZ
-----END RSA PRIVATE KEY-----';
    private static $PUBLIC_KEY = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDbyXU6cNOxIktF1dLkztVrVl3Y
XLfJ4DciCqlDFwRWMuu4nKvwjgnycA2ngNWFQThz9xe1iUjWed2fyn1RXItOWE6N
lrGLp7w81o+9EIK+7yCmdmx0Ibpk0NiAJcNudoBgIOieyMvuab40sefEuluUMgNP
kUV8SN0dqpddImcStwIDAQAB
-----END PUBLIC KEY-----';
    /**
     *返回对应的私钥
     */
    private static function getPrivateKey(){

        $privKey = self::$PRIVATE_KEY;

        return openssl_pkey_get_private($privKey);
    }

    public static function privEncrypt($data)
    {
        if(!is_string($data)){
            return null;
        }
        return openssl_private_encrypt($data,$encrypted,self::getPrivateKey())? base64_encode($encrypted) : null;
    }

    public static function privDecrypt($encrypted)
    {
        if(!is_string($encrypted)){
            return null;
        }
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey()))? $decrypted : null;
    }

    private static function getPublicKey(){

        $privKey = self::$PUBLIC_KEY;

        return openssl_get_publickey($privKey);
    }

    public static function pubEncrypt($data)
    {
        if(!is_string($data)){
            return null;
        }
        return openssl_public_encrypt($data,$encrypted,self::getPublicKey())? base64_encode($encrypted) : null;
    }

    public static function pubDecrypt($encrypted)
    {
        if(!is_string($encrypted)){
            return null;
        }
        return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, self::getPublicKey()))? $decrypted : null;
    }

}