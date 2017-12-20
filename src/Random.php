<?php

/**
 * Random.php
 * 
 * PHP version 5
 * 
 * @category Dcrypt
 * @package  Dcrypt
 * @author   Michael Meyer (mmeyer2k) <m.meyer2k@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/mmeyer2k/dcrypt
 * @link     https://apigen.ci/github/mmeyer2k/dcrypt
 */

namespace Dcrypt;

/**
 * Fail-safe wrapper for mcrypt_create_iv (preferably) and
 * openssl_random_pseudo_bytes (fallback).
 *
 * @category Dcrypt
 * @package  Dcrypt
 * @author   Michael Meyer (mmeyer2k) <m.meyer2k@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/mmeyer2k/dcrypt
 * @link     https://apigen.ci/github/mmeyer2k/dcrypt/class-Dcrypt.Random.html
 */
final class Random
{
    /**
     * Return securely generated random bytes.
     * 
     * @param int  $bytes  Number of bytes to get
     * 
     * @return string
     */
    public static function bytes(int $bytes): string
    {        
        $ret = \random_bytes($bytes);
        
        if (Str::strlen($ret) !== $bytes) {
            self::toss(); // @codeCoverageIgnore
        }
        
        return $ret;
    }

    /**
     * Throw an error when a failure occurs.
     * 
     * @codeCoverageIgnore
     */
    private static function toss()
    {
        $e = 'Dcrypt failed to generate a random number';
        throw new \exception($e);
    }
    

    /**
     * Deterministic seeded array shuffle function. Does not keep keys.
     *
     * @param array  $array  Array to shuffle
     * @param string $seed   Seed to use 
     * @param bool   $secure Whether to use secure RNG in PHP 7.1+. Use false to fall back to broken version for BC.
     *
     * @return array
     */
    public static function shuffle(array $array, string $seed, bool $secure = true): array
    {
        $count = \count($array);

        $range = \range(0, $count - 1);

        // Hash the seed and extract bytes to make integer with
        $seed = Str::substr(\hash('sha256', $seed, true), 0, PHP_INT_SIZE);

        // Convert bytes to an int
        $seed = \unpack("L", $seed);

        if (\version_compare(PHP_VERSION, '7.1.0') >= 0 && $secure === false) {
            // Handle PHP 7.1+ calls requiring the old implementation which has broken implementation
            \mt_srand($seed[1], MT_RAND_PHP);
        } else {
            \mt_srand($seed[1]);
        }

        // Swap array values randomly
        foreach ($range as $a) {
            $b = \mt_rand(0, $count - 1);

            $v = $array[$a];

            $array[$a] = $array[$b];

            $array[$b] = $v;
        }

        return $array;
    }
}
