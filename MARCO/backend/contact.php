<?php

require __DIR__ . '/config/bootstrap.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$requestOrigin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigin = $config['allowed_origin'];

if ($requestOrigin !== '' && in_array($requestOrigin, $config['allowed_origins'], true)) {
    $allowedOrigin = $requestOrigin;
}

header('Access-Control-Allow-Origin: ' . $allowedOrigin);
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Vary: Origin');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

function jsonResponse(bool $success, string $message, int $code = 200): void
{
    http_response_code($code);
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Neispravan zahtjev.', 405);
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if (!RateLimiter::check($ip, $config['rate_limit_seconds'], $config['rate_limit_max'])) {
    jsonResponse(false, 'Poslali ste previše poruka. Pokušajte ponovo kasnije.', 429);
}

$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

if (!is_array($data)) {
    jsonResponse(false, 'Neispravan format podataka.', 400);
}

[$valid, $error, $validatedData] = ContactValidator::validate($data);

if (!$valid) {
    jsonResponse(false, $error, 400);
}

try {
    MailService::sendContactMail($config, $validatedData);

    jsonResponse(true, 'Poruka je uspješno poslata.');
} catch (Throwable $e) {
    Logger::error('Contact form error: ' . $e->getMessage());

    jsonResponse(false, 'Greška pri slanju poruke. Pokušajte ponovo kasnije.', 500);
}