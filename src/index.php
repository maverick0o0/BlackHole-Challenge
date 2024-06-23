<?php

require 'secret.php';

error_reporting(0);



if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['gravity'])) {
    show_source('index.php');
    exit;
}


function encryptMessage($message, $key)
{
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);
    $encrypted = openssl_encrypt($message, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $ivBase64 = base64_encode($iv);
    $encryptedBase64 = base64_encode($encrypted);
    return $ivBase64 . '.' . $encryptedBase64;
}

function decryptMessage($encryptedMessage, $key)
{
    list($ivBase64, $encryptedBase64) = explode('.', $encryptedMessage, 2);
    $iv = base64_decode($ivBase64);
    $encrypted = base64_decode($encryptedBase64);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['black_hole_source_value'])) {
    setcookie('encrypted_message', encryptMessage('user', $key), time() - (86400 * 30), '/');
    exit;
}

if (isset($_COOKIE['encrypted_message'])) {
    if (strstr($_COOKIE['encrypted_message'], '=') === False) {
        if (decryptMessage($_COOKIE['encrypted_message'], $key) == shell_exec('echo blackhole')) {
            echo getenv('LEVEL_21');
            die();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Escape the Blackhole - Level 20</title>
</head>

<body>
    <img src="./blackhole.jpg" key="gravity">
</body>

</html>

