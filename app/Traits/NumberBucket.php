<?php

namespace App\Traits;

trait NumberBucket
{
    public static function numberToBucket(float $balance, int $size = 100): string
    {
        $bucketStart = floor($balance / $size) * $size;
        $bucketEnd   = $bucketStart + $size - 1;
        return "{$bucketStart}-{$bucketEnd}";
    }
}
