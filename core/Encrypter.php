<?php

namespace Core;


/**
 * Encrypt and decrypt strings.
 */
class Encrypter
{
    protected $secretKey = '';
    protected $secretIv = '';
    protected $encryptMethod = "AES-256-CBC";



    public function __construct($secretKey=null, $secretIv=null)
    {
        $this->secretKey = $secretKey ?? 'secret_key';
        $this->secretIv = $secretIv ?? 'secret_iv';
    }


    /**
     * Encrypt a string.
     *
     * @param string $string string to encrypt
     * @return string
     */
    public function encrypt($string)
    {
        extract($this->getKeyAndIv());

        return base64_encode(openssl_encrypt($string, $this->encryptMethod, $key, 0, $iv ));
    }



    /**
     * Decrypt a string.
     *
     * @param string $string string to decrypt
     * @return string
     */
    public function decrypt($string)
    {
        extract($this->getKeyAndIv());

        return openssl_decrypt(base64_decode($string), $this->encryptMethod, $key, 0, $iv);
    }



    /**
     * Return the hashed secret key and the IV.
     *
     * @return array
     */
    protected function getKeyAndIv()
    {
        return [
            'key' => hash('sha256', $this->secretKey),
            'iv' => substr(hash('sha256', $this->secretIv ), 0, 16),
        ];
    }
}
