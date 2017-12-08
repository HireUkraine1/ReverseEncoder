<?php

namespace HireUkraine\ReversibleEncryption;

class ReverseEncoder
{
    private $cipher = "AES-128-CBC";

    public function encrypt($data, $secret)
    {
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $raw_data = openssl_encrypt($data, $this->cipher, $secret, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $raw_data, $secret,  true);
        $encryptData = base64_encode($iv . $hmac . $raw_data);
        return $encryptData;
    }


    public function decrypt($data, $secret)
    {
        $ciphertext = base64_decode($data);
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = substr($ciphertext, 0, $ivlen);
        $hmac = substr($ciphertext, $ivlen, $sha2len = 32);
        $raw_data = substr($ciphertext, $ivlen + $sha2len);
        $original_data = openssl_decrypt($raw_data, $this->cipher, $secret,OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $raw_data, $secret, true);
        if (hash_equals($hmac, $calcmac)) {
            return $original_data;
        }
        return false;
    }

}