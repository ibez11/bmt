<?php

function getMerchantId() {
    include 'apiconfig.php';
    $ch = curl_init();
    $fields = array(
        'token' => $token,
    );
    $postvars = json_encode($fields);
    $url = "https://blaaaa.com";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $result = curl_exec($ch);
    echo $result;
}

?>