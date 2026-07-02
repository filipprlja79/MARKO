<?php

class Logger
{
    public static function error(string $message): void
    {
        $dir = __DIR__ . '/../storage/logs';

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;

        file_put_contents($dir . '/errors.log', $line, FILE_APPEND);
    }
}