<?php declare(strict_types=1);

/*
 * Generates the openssl-related test vectors in tests/vectors
 */

use \Dcrypt\OpensslStatic;

require __DIR__ . '/../vendor/autoload.php';

$out = [];

foreach (\Dcrypt\OpensslSupported::ciphers() as $cipher) {
    $cipher = strtolower($cipher);
    if (isset($out[$cipher])) {
        continue;
    }

    try {
        $out[$cipher] = base64_encode(OpensslStatic::encrypt('hello', 'world', $cipher, 'sha256', 1000));
    } catch (\Exception|\Error $e) {

    }
}

file_put_contents(__DIR__ . '/../tests/vectors/openssl-static-ciphers.json', \json_encode($out, JSON_PRETTY_PRINT));

$out = [];

foreach (\Dcrypt\OpensslSupported::algos() as $algo) {
    $cipher = strtolower($algo);
    if (isset($out[$algo])) {
        continue;
    }
    $out[$algo] = base64_encode(OpensslStatic::encrypt('hello', 'world', 'aes-256-gcm', $algo, 1000));
}

file_put_contents(__DIR__ . '/../tests/vectors/openssl-static-algos.json', \json_encode($out, JSON_PRETTY_PRINT));

$out = [];

foreach (range(1, 10) as $r) {
    $mult = $r * $r * 10;

    $out[$mult] = \base64_encode(\Dcrypt\Otp::crypt(str_repeat('A', $mult), 'password', 1000));
}

file_put_contents(__DIR__ . '/../tests/vectors/otp.json', \json_encode($out, JSON_PRETTY_PRINT));