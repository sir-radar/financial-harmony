<?php

namespace App\Services;

use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\KeyProvider\StringProvider;
use ParagonIE\CipherSweet\Backend\FIPSCrypto;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\Backend\Key\SymmetricKey;

class CryptoService
{
    protected CipherSweet $engine;

    public function __construct()
    {
        $key = base64_decode(str_replace('base64:', '', config('app.ciphersweet_key')));
        $provider = new StringProvider($key);
        $this->engine = new CipherSweet($provider, new FIPSCrypto());
    }

    public function encrypt(string $value): string
    {

        return $this->engine->getBackend()->encrypt($value, new SymmetricKey(config('app.ciphersweet_key')));
    }

    public function decrypt(string $ciphertext): string
    {
        return $this->engine->getBackend()->decrypt($ciphertext, new SymmetricKey('app.ciphersweet_key'));
    }

    public function blindIndex(string $field, string $value): string
    {
        return hash_hmac('sha256', $value, config('app.key') . $field);
    }
}
