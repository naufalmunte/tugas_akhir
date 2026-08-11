<?php

$url = 'https://app.sandbox.midtrans.com';

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_CAINFO => 'C:\xampp\php\extras\ssl\cacert.pem',
]);

$result = curl_exec($ch);

echo "RESULT:\n";
var_dump($result);

echo "\n\nCURL ERROR:\n";
var_dump(curl_error($ch));

echo "\n\nCURL ERRNO:\n";
var_dump(curl_errno($ch));

echo "\n\nCURL VERSION:\n";
var_dump(curl_version());

curl_close($ch);