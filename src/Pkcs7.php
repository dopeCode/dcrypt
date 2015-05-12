<?php

/**
 * Pkcs7.php
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
 * Provides PKCS #7 padding functionality.
 * 
 * @category Dcrypt
 * @package  Dcrypt
 * @author   Michael Meyer (mmeyer2k) <m.meyer2k@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/mmeyer2k/dcrypt
 */
class Pkcs7
{

    /**
     * PKCS #7 padding function.
     * 
     * @param string  $input     String to pad
     * @param integer $blocksize Block size in bytes (default is 32)
     * 
     * @return string
     */
    public static function pad($input, $blocksize = 32)
    {
        // Determine the padding string that needs to be appended.
        $pad = self::_paddingString(strlen($input), $blocksize);

        // Return input + padding
        return $input . $pad;
    }

    /**
     * Determine the size of the padding to use.
     * 
     * @param integer $inputsize Size of the input in bytes.
     * @param integer $blocksize Size of the output in bytes.
     * 
     * @return integer
     */
    private static function _paddingString($inputsize, $blocksize)
    {
        // Determine the amount of padding to use
	$pad = $blocksize - ($inputsize % $blocksize);
		
	return str_repeat(chr($pad), $pad);
    }

    /**
     * PKCS #7 unpadding function.
     * 
     * @param string $input Padded string to unpad.
     * 
     * @return string
     */
    public static function unpad($input)
    {
        // Determine the padding size by converting the final byte of the  
        // input to its decimal value.
        $padsize = ord(substr($input, -1));

        // Return string minus the padding amount.
        return substr($input, 0, strlen($input) - $padsize);
    }

}