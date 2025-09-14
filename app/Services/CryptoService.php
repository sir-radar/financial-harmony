<?php

namespace App\Services;

use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\KeyProvider\StringProvider;
use ParagonIE\CipherSweet\Backend\FIPSCrypto;
use ParagonIE\CipherSweet\Backend\Key\SymmetricKey;

class CryptoService
{
    protected CipherSweet $engine;
    protected SymmetricKey $key;

    public function __construct()
    {
        // Load and decode the key only once
        $rawKey = str_replace('base64:', '', config('app.ciphersweet_key'));
        $decodedKey = base64_decode($rawKey);

        $this->key = new SymmetricKey($decodedKey);

        $provider = new StringProvider($decodedKey);
        $this->engine = new CipherSweet($provider, new FIPSCrypto());
    }

    public function encrypt(string $value): string
    {
        return $this->engine->getBackend()->encrypt($value, $this->key);
    }

    public function decrypt(string $ciphertext): string
    {
        return $this->engine->getBackend()->decrypt($ciphertext, $this->key);
    }

    public function blindIndex(string $field, string $value): string
    {
        return hash_hmac('sha256', $value, config('app.key') . $field);
    }
}
