<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class CacheService
{
    public static function put(string $prefix, $id, $value, ?int $ttl = null)
    {
        $key = $prefix.$id;

        $data = json_encode($value);

        if ($ttl) {
            return Redis::setex($key, $ttl, $data);
        }

        return Redis::set($key, $data);
    }

    public static function get(string $prefix, $id)
    {
        $key = $prefix.$id;

        $data = Redis::get($key);

        return $data ? json_decode($data) : null;
    }

    public static function forget(string $prefix, $id)
    {
        $key = $prefix.$id;

        return Redis::del($key);
    }
}
