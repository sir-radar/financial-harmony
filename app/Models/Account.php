<?php

namespace App\Models;

use App\Traits\NumberBucket;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use NumberBucket;
    protected $fillable = ['name', 'email', 'account_number', 'balance', 'ssn'];

    protected $hidden = ['account_number_index', 'balance_index', 'ssn_index', 'created_at', 'updated_at'];

    /**
     * Encrypt + Blind Index - Account Number
     */
    public function setAccountNumberAttribute($value)
    {
        $this->attributes['account_number'] = app('crypto')->encrypt($value);
        $this->attributes['account_number_index'] = app('crypto')->blindIndex('account_number', $value);
    }

    public function getAccountNumberAttribute()
    {
        return app('crypto')->decrypt($this->attributes['account_number']);
    }

    /**
     * Encrypt + Bucketized Blind Index for improved range queries - Balance
     */
    public function setBalanceAttribute($value)
    {
        // Encrypt raw balance
        $this->attributes['balance'] = app('crypto')->encrypt((string) $value);

        // Store bucketized blind index
        $bucket = self::numberToBucket((float) $value);
        $this->attributes['balance_index'] = app('crypto')->blindIndex('balance_bucket', $bucket);
    }

    public function getBalanceAttribute()
    {
        return (float) app('crypto')->decrypt($this->attributes['balance']);
    }

    /**
     * Encrypt + Blind Index - SSN
     */
    public function setSsnAttribute($value)
    {
        $this->attributes['ssn'] = app('crypto')->encrypt($value);
        $this->attributes['ssn_index'] = app('crypto')->blindIndex('ssn', $value);
    }

    public function getSsnAttribute()
    {
        return app('crypto')->decrypt($this->attributes['ssn']);
    }

    /**
     * Query helpers
     */
    public static function findByAccountNumber(string $number)
    {
        $index = app('crypto')->blindIndex('account_number', $number);
        return static::where('account_number_index', $index)->firstOrFail();
    }

    public static function findBySsn(string $ssn)
    {
        $index = app('crypto')->blindIndex('ssn', $ssn);
        return static::where('ssn_index', $index)->first();
    }

    public static function findByBalanceRange(float $min, float $max, int $size = 100)
    {
        $minBucket = floor($min / $size) * $size;
        $maxBucket = floor($max / $size) * $size;

        $buckets = [];
        for ($bucket = $minBucket; $bucket <= $maxBucket; $bucket += $size) {
            $bucketKey = self::numberToBucket($bucket, $size);
            $buckets[] = app('crypto')->blindIndex('balance_bucket', $bucketKey);
        }
        // 🚨 Prevent too many placeholders
        if (count($buckets) > 500) {
            // Fallback: scan in chunks of 500 buckets
            $results = collect();
            foreach (array_chunk($buckets, 500) as $chunk) {
                $partial = static::whereIn('balance_index', $chunk)->get();
                $results = $results->merge($partial);
            }
        } else {
            $results = static::whereIn('balance_index', $buckets)->get();
        }

        // Final filtering after decrypt
        return $results->filter(function ($account) use ($min, $max) {
            return $account->balance >= $min && $account->balance <= $max;
        })->values();
    }
}
