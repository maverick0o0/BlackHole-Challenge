<?php

error_reporting(0);

$key="HelloThisIsKey";

function encryptMessage($message, $key)
{
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);
    $encrypted = openssl_encrypt($message, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $ivBase64 = base64_encode($iv);
    $encryptedBase64 = base64_encode($encrypted);
    return $ivBase64 . '.' . $encryptedBase64;
}



$result = encryptMessage("user", $key);
echo $result;



