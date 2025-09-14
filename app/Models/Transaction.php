<?php

namespace App\Models;

use App\Traits\NumberBucket;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use NumberBucket;
    protected $fillable = ['account_id', 'amount', 'type', 'description', 'card_number', 'cvv'];

    protected $hidden = ['amount_index', 'card_number_index', 'created_at', 'updated_at'];


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = app('crypto')->encrypt((string) $value);

        $bucket = self::numberToBucket((float) $value);
        $this->attributes['amount_index'] = app('crypto')->blindIndex('amount_bucket', (string) $bucket);
    }

    public function getAmountAttribute()
    {
        return (float) app('crypto')->decrypt($this->attributes['amount']);
    }

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = app('crypto')->encrypt($value);
        $this->attributes['card_number_index'] = app('crypto')->blindIndex('card_number', $value);
    }

    public function getCardNumberAttribute()
    {
        return app('crypto')->decrypt($this->attributes['card_number']);
    }

    public function setCvvAttribute($value)
    {
        $this->attributes['cvv'] = app('crypto')->encrypt($value);
    }

    public function getCvvAttribute()
    {
        return app('crypto')->decrypt($this->attributes['cvv']);
    }

    // Query helpers
    public static function findByAccountNumber(string $accountNumber)
    {
        $account = Account::findByAccountNumber($accountNumber);
        return $account ? static::where('account_id', $account->id)->get() : collect();
    }

    public static function findByAmountRange(float $min, float $max, $size = 100)
    {
        $minBucket = floor($min / $size) * $size;
        $maxBucket = floor($max / $size) * $size;

        $buckets = [];
        for ($bucket = $minBucket; $bucket <= $maxBucket; $bucket += $size) {
            $bucketKey = self::numberToBucket($bucket, $size);
            $buckets[] = app('crypto')->blindIndex('amount_bucket', $bucketKey);
        }
        // 🚨 Prevent too many placeholders
        if (count($buckets) > 500) {
            // Fallback: scan in chunks of 500 buckets
            $results = collect();
            foreach (array_chunk($buckets, 500) as $chunk) {
                $partial = static::whereIn('amount_index', $chunk)->get();
                $results = $results->merge($partial);
            }
        } else {
            $results = static::whereIn('amount_index', $buckets)->get();
        }

        // Final filtering after decrypt
        return $results->filter(function ($transaction) use ($min, $max) {
            return $transaction->amount >= $min && $transaction->amount <= $max;
        })->values();
    }
}
