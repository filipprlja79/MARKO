<?php

$autoloadPaths = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
    __DIR__ . '/../../../vendor/autoload.php',
];

foreach ($autoloadPaths as $path) {
    if (file_exists($path)) {
        require $path;
        break;
    }
}

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../services/' . $class . '.php',
        __DIR__ . '/../validators/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require $path;
            return;
        }
    }
});

function envValue(string $key, $default = null)
{
    static $env = null;

    if ($env === null) {
        $env = [];
        $file = __DIR__ . '/../.env';

        if (file_exists($file)) {
            foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                if (str_starts_with(trim($line), '#'))
                    continue;

                [$name, $value] = array_pad(explode('=', $line, 2), 2, null);
                $env[trim($name)] = trim($value ?? '');
            }
        }
    }

    return $env[$key] ?? $default;
}

$config = [
    'allowed_origin' => envValue('ALLOWED_ORIGIN', 'https://meatgroup.me'),

    'smtp_host' => envValue('SMTP_HOST'),
    'smtp_port' => (int) envValue('SMTP_PORT', 587),
    'smtp_secure' => envValue('SMTP_SECURE', 'tls'),
    'smtp_username' => envValue('SMTP_USERNAME'),
    'smtp_password' => envValue('SMTP_PASSWORD'),

    'mail_from' => envValue('MAIL_FROM'),
    'mail_from_name' => envValue('MAIL_FROM_NAME', 'MARCO'),
    'mail_to' => envValue('MAIL_TO'),

    'rate_limit_seconds' => (int) envValue('RATE_LIMIT_SECONDS', 600),
    'rate_limit_max' => (int) envValue('RATE_LIMIT_MAX', 5),
];