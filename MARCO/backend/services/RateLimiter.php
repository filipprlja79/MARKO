<?php

class RateLimiter
{
    public static function check(string $ip, int $seconds, int $maxRequests): bool
    {
        $file = __DIR__ . '/../storage/rate-limit.json';
        $now = time();

        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }

        $data = json_decode(file_get_contents($file), true) ?: [];

        $data = array_filter($data, function ($item) use ($now, $seconds) {
            return isset($item['time']) && ($now - $item['time']) < $seconds;
        });

        $userRequests = array_filter($data, function ($item) use ($ip) {
            return isset($item['ip']) && $item['ip'] === $ip;
        });

        if (count($userRequests) >= $maxRequests) {
            file_put_contents($file, json_encode(array_values($data)));
            return false;
        }

        $data[] = [
            'ip' => $ip,
            'time' => $now
        ];

        file_put_contents($file, json_encode(array_values($data)));

        return true;
    }
}