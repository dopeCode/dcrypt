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
 */
class Random
{

    /**
     * Get random bytes from Mcrypt
     * 
     * @param int $bytes Number of bytes to get
     * 
     * @return string
     */
     private static function _fromMcrypt($bytes)
     {
        $ret = mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM);
        
        if ($ret === false) {
            self::_toss(); // @codeCoverageIgnore
        }
        
        return $ret;
     }
     
    /**
     * Get random bytes from Openssl
     * 
     * @param int $bytes Number of bytes to get
     * 
     * @return string
     */
     private static function _fromOpenssl($bytes)
     {
        // @codeCoverageIgnoreStart
        $ret = openssl_random_pseudo_bytes($bytes, $secure);
        
        if ($secure === false) {
            self::_toss();
        }
        
        return $ret;
        // @codeCoverageIgnoreEnd
     }

    /**
     * Return securely generated random bytes.
     * 
     * @param int  $bytes  Number of bytes to get
     * @param bool $mcrypt Whether to use mcrypt_create_iv as first choice.
     * 
     * @return string
     */
    public static function get($bytes, $mcrypt = true)
    {
        if (function_exists('mcrypt_create_iv') && $mcrypt === true) {
            return self::_fromMcrypt($bytes);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            return self::_fromOpenssl($bytes);
        } else {
            self::_toss();
        }
    }

    /*
     * Throw an error when a failure occurs.
     */
    private static function _toss()
    {
        $e = 'Dcrypt failed to generate a random number';
        throw new \exception($e);
    }

}
