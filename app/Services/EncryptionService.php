<?php
namespace App\Services;

class EncryptionService {
    private $key;
    private $cipher = "AES-256-CBC";

    public function __construct() {
        $this->key = ENCRYPTION_KEY;
    }

    public function encrypt($data) {
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = random_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($data, $this->cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);
        return base64_encode($iv . $hmac . $ciphertext_raw);
    }

    public function decrypt($ciphertext) {
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $this->cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);
        if (hash_equals($hmac, $calcmac)) {
            return $original_plaintext;
        }
        return false;
    }
}