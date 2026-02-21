<?php

class RateLimiter
{
    private const SESSION_KEY = '_rate_limiter';

    public static function tooManyAttempts(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        self::prune($key, $decaySeconds);
        return self::attempts($key) >= $maxAttempts;
    }

    public static function hit(string $key, int $decaySeconds): int
    {
        self::prune($key, $decaySeconds);

        if (!isset($_SESSION[self::SESSION_KEY][$key])) {
            $_SESSION[self::SESSION_KEY][$key] = [];
        }

        $_SESSION[self::SESSION_KEY][$key][] = time();
        return count($_SESSION[self::SESSION_KEY][$key]);
    }

    public static function attempts(string $key): int
    {
        return count($_SESSION[self::SESSION_KEY][$key] ?? []);
    }

    public static function availableIn(string $key, int $decaySeconds): int
    {
        self::prune($key, $decaySeconds);

        $attempts = $_SESSION[self::SESSION_KEY][$key] ?? [];
        if (empty($attempts)) {
            return 0;
        }

        $oldestTimestamp = $attempts[0];
        $retryAfter = ($oldestTimestamp + $decaySeconds) - time();
        return max(0, $retryAfter);
    }

    public static function clear(string $key): void
    {
        unset($_SESSION[self::SESSION_KEY][$key]);
    }

    private static function prune(string $key, int $decaySeconds): void
    {
        $attempts = $_SESSION[self::SESSION_KEY][$key] ?? [];
        if (empty($attempts)) {
            return;
        }

        $threshold = time() - $decaySeconds;
        $freshAttempts = array_values(array_filter($attempts, static function ($timestamp) use ($threshold) {
            return $timestamp > $threshold;
        }));

        if (empty($freshAttempts)) {
            unset($_SESSION[self::SESSION_KEY][$key]);
            return;
        }

        $_SESSION[self::SESSION_KEY][$key] = $freshAttempts;
    }
}
