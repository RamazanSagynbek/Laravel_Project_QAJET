<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

abstract class Controller
{
    use AuthorizesRequests;

    /**
     * Cache with graceful fallback to direct execution if Redis is unavailable.
     */
    protected function cacheRemember(string $key, int $ttl, \Closure $callback): mixed
    {
        try {
            return Cache::remember($key, $ttl, $callback);
        } catch (\Exception $e) {
            return $callback();
        }
    }
}
