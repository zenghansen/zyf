<?php
/**
 * Created by IntelliJ IDEA.
 * User: yamei
 * Date: 2018/9/9
 * Time: 9:54
 */

class Rsa
{
    private static $PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBANvJdTpw07EiS0XV
0uTO1WtWXdhct8ngNyIKqUMXBFYy67icq/COCfJwDaeA1YVBOHP3F7WJSNZ53Z/K
fVFci05YTo2WsYunvDzWj70Qgr7vIKZ2bHQhumTQ2IAlw252gGAg6J7Iy+5pvjSx
58S6W5QyA0+RRXxI3R2ql10iZxK3AgMBAAECgYEApjPfAVWGz+GGGIZMl5hNTYEf
MFlU5kU2i/iR7Nj//4s8M/vODffrT7kqqitDzCP448DL3gy11vKLBKXkRF1+PVad
ZxhwFP23rkKQtdwUEMb9tjGAaSk0EdSAyJZpLGldYImTlcAJnioqTpXinfEX9tDo
CCCYel6fEQz0lfO2bmkCQQD02YRdF0vv6yjzZOifGNM0f3+LUcsBJ1zR7N3sak7j
f9ped1f1XkSzLoL44HPO/cdTM7gZSTIJq5MVp2kVLZzTAkEA5cvBx+2lB/znBJ6f
wA9Oq3yZfUlQBKXr6F1L1Dp2JB0ycHWRS2gtEw79jAppQX9YjDrZZLxJ9lS/DwBa
vc/0DQJAAibnQuoxgKpQcdMxODS/pnZ4aIEPh7MQ3cd3K9zDVLyK7smdvEpX0DtY
a1eNrQQN/G038QDzr6ISaN5Pzh/YgQJBANUjIf9AClvYVKXSQrWu/PbNwMeV4iQN
iTuinRyhhMaGViw8v6DDZVtSAhWL6oiXhxe51b07bxaNEBDn8UIwyVkCQE7Zl/vN
KlLUT2e4fESWNivOsj4r6jmqrF+a2lS3zEky95bI/+ilVYEeSVwHn/DOWZVcwUqt
Q5U/M3ZbOjflnNk=
-----END PRIVATE KEY-----';
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

$a = Rsa::pubEncrypt("123");
echo $b = Rsa::privDecrypt($a);