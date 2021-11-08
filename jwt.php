<?php

function buat_jwt($data) {
    // secretnya
    $secret = "polkesyojogja";
    // headernya
    $header = json_encode([
        'type' => 'JWT',
        'alg'  => 'HS256',
    ]);
    $base64header = base64_encode($header);

    // payloadnya
    $payload = json_encode([
        'username' => $data,
        'iat'      => date('Y-m-d H:i:s'),
    ]);
    $base64payload = base64_encode($payload);

    // signature
    $signature = $base64header . "." . $base64payload;

    // encode hasmac
    $signatureHashMac = hash_hmac('sha256', $signature, $secret);

    // token gabungan
    $token = $base64header . "." . $base64payload . "." . $signatureHashMac;
    return $token;
}

function validasi_jwt($data) {}

?>