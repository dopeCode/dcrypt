<?php

require __DIR__ . '/../vendor/autoload.php';

$out1 = [];

$algos = [
    "sha224",
    "sha256",
    "sha384",
    "sha512/224",
    "sha512/256",
    "sha512",
    "sha3-224",
    "sha3-256",
    "sha3-384",
    "sha3-512",
    "ripemd128",
    "ripemd160",
    "ripemd256",
    "ripemd320",
    "whirlpool",
    "tiger128,3",
    "tiger160,3",
    "tiger192,3",
    "tiger128,4",
    "tiger160,4",
    "tiger192,4",
    "snefru",
    "snefru256",
    "gost",
    "gost-crypto",
    "haval128,3",
    "haval160,3",
    "haval192,3",
    "haval224,3",
    "haval256,3",
    "haval128,4",
    "haval160,4",
    "haval192,4",
    "haval224,4",
    "haval256,4",
    "haval128,5",
    "haval160,5",
    "haval192,5",
    "haval224,5",
    "haval256,5",
];

$ciphers = [
    "aes-128-cbc",
    "aes-128-cbc-hmac-sha1",
    "aes-128-cbc-hmac-sha256",
    "aes-128-ccm",
    "aes-128-cfb",
    "aes-128-cfb1",
    "aes-128-cfb8",
    "aes-128-ctr",
    "aes-128-ecb",
    "aes-128-gcm",
    "aes-128-ocb",
    "aes-128-ofb",
    "aes-192-cbc",
    "aes-192-ccm",
    "aes-192-cfb",
    "aes-192-cfb1",
    "aes-192-cfb8",
    "aes-192-ctr",
    "aes-192-ecb",
    "aes-192-gcm",
    "aes-192-ocb",
    "aes-192-ofb",
    "aes-256-cbc",
    "aes-256-cbc-hmac-sha1",
    "aes-256-cbc-hmac-sha256",
    "aes-256-ccm",
    "aes-256-cfb",
    "aes-256-cfb1",
    "aes-256-cfb8",
    "aes-256-ctr",
    "aes-256-ecb",
    "aes-256-gcm",
    "aes-256-ocb",
    "aes-256-ofb",
    "bf-cbc",
    "bf-cfb",
    "bf-ecb",
    "bf-ofb",
    "camellia-128-cbc",
    "camellia-128-cfb",
    "camellia-128-cfb1",
    "camellia-128-cfb8",
    "camellia-128-ctr",
    "camellia-128-ecb",
    "camellia-128-ofb",
    "camellia-192-cbc",
    "camellia-192-cfb",
    "camellia-192-cfb1",
    "camellia-192-cfb8",
    "camellia-192-ctr",
    "camellia-192-ecb",
    "camellia-192-ofb",
    "camellia-256-cbc",
    "camellia-256-cfb",
    "camellia-256-cfb1",
    "camellia-256-cfb8",
    "camellia-256-ctr",
    "camellia-256-ecb",
    "camellia-256-ofb",
    "cast5-cbc",
    "cast5-cfb",
    "cast5-ecb",
    "cast5-ofb",
    "chacha20",
    "chacha20-poly1305",
    "des-cbc",
    "des-cfb",
    "des-cfb1",
    "des-cfb8",
    "des-ecb",
    "des-ede",
    "des-ede-cbc",
    "des-ede-cfb",
    "des-ede-ofb",
    "des-ede3",
    "des-ede3-cbc",
    "des-ede3-cfb",
    "des-ede3-cfb1",
    "des-ede3-cfb8",
    "des-ede3-ofb",
    "des-ofb",
    "desx-cbc",
    "id-aes128-CCM",
    "id-aes128-GCM",
    "id-aes192-CCM",
    "id-aes192-GCM",
    "id-aes256-CCM",
    "id-aes256-GCM",
    "rc2-40-cbc",
    "rc2-64-cbc",
    "rc2-cbc",
    "rc2-cfb",
    "rc2-ecb",
    "rc2-ofb",
    "rc4",
    "rc4-40",
    "rc4-hmac-md5",
    "seed-cbc",
    "seed-cfb",
    "seed-ecb",
    "seed-ofb",
];

foreach ($ciphers as $cipher) {
    $out2 = [];

    foreach ($algos as $algo) {
        $out2[$algo] = base64_encode(\Dcrypt\OpensslStatic::encrypt('hello', 'world', $cipher, $algo, 10));
    }

    $out1[$cipher] = $out2;
}

echo json_encode($out1, JSON_PRETTY_PRINT);