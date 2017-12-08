<?php

use HireUkraine\ReversibleEncryption\ReverseEncoder;

class ReverseEncoderTest extends TestCase
{
    private $key = 'secret key';

    private $data = 'some data';

    private $reverseEncoder;

    public function __construct()
    {
        $this->reverseEncoder = new ReverseEncoder;
    }

    public function testEncrypt()
    {
        $encrypt = $this->reverseEncoder->encrypt($this->data, $this->key);

        $this->assertTrue($encrypt != $this->data);
    }

    public function testDecryptTrue()
    {
        $encrypt = $this->reverseEncoder->encrypt($this->data, $this->key);
        $decrypt = $this->reverseEncoder->decrypt($encrypt, $this->key);

        $this->assertTrue($decrypt == $this->data);
    }

    public function testDecryptFalse()
    {
        $encrypt = $this->reverseEncoder->encrypt($this->data, $this->key);
        $decrypt = $this->reverseEncoder->decrypt($encrypt, 'wrong key');

        $this->assertFalse($decrypt);
    }
}



