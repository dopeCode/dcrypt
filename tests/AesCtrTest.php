<?php

use Dcrypt\AesCtr;

class AesCtrTest extends PHPUnit_Framework_TestCase
{

    public function testPbkdf()
    {
        $input = 'AAAAAAAA';
        $key = 'AAAAAAAA';
        $encrypted = AesCtr::encrypt($input, $key, 10);
        $this->assertEquals($input, AesCtr::decrypt($encrypted, $key, 10));
        #$corrupt = \Dcrypt\Support\Support::swaprandbyte($encrypted);
        #$this->assertFalse(AesCtr::decrypt($corrupt, $key, 10));
    }

    public function testEngine()
    {
        $input = 'AAAAAAAA';
        $key = 'AAAAAAAA';
        $encrypted = AesCtr::encrypt($input, $key);
        $this->assertEquals($input, AesCtr::decrypt($encrypted, $key));
        // Perform a validation by replacing a random byte to make sure
        // the decryption fails. After enough successful runs,
        // all areas of the cypher text will have been tested
        // for integrity
        #$corrupt = \Dcrypt\Support\Support::swaprandbyte($encrypted);
        # AesCtr::decrypt($corrupt, $key);
    }

    public function testVector()
    {
        $input = 'hello world';
        $pass = 'password';
        $vector = \base64_decode('Vpbd71CIVcRPALeSg126DhRKYozXlbusn/eSSxrQPtzj/U7hOhlN8D21Y0gmlmUKorpoXuDS6bklvD8=');
        $this->assertEquals($input, AesCtr::decrypt($vector, $pass));
    }

}
