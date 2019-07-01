<?php declare(strict_types=1);

use Dcrypt\Exceptions\InvalidKeyException;
use Dcrypt\Exceptions\InvalidPasswordException;

class OpensslKeyGeneratorTest extends \PHPUnit\Framework\TestCase
{
    public function testNewKeyTooShort()
    {
        \Dcrypt\OpensslKeyGenerator::newKey(256);

        $this->expectException(InvalidKeyException::class);

        \Dcrypt\OpensslKeyGenerator::newKey(128);
    }

    public function testKeyWithCostException()
    {
        $key = \Dcrypt\OpensslKeyGenerator::newKey(256);

        $this->expectException(InvalidPasswordException::class);

        new \Dcrypt\OpensslKeyGenerator('sha256', $key, 'aes-256-gcm', \random_bytes(128), 10000);
    }
}
