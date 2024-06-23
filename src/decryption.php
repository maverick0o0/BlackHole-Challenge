<?php
error_reporting(0);


$key="HelloThisIsKey";


function decryptMessage($encryptedMessage, $key)
{
    list($ivBase64, $encryptedBase64) = explode('.', $encryptedMessage, 2);
    $iv = base64_decode($ivBase64);
    $encrypted = base64_decode($encryptedBase64);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}


$result = decryptMessage("lhwEIl9QhJ5PVSw7M0Xr6w==.AtbP+IF22bxMNsz+vVHm5g==", $key);
echo $result;
