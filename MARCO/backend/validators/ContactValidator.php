<?php

class ContactValidator
{
    public static function validate(array $data): array
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $message = trim($data['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            return [false, 'Molimo popunite obavezna polja.', []];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, 'Email adresa nije validna.', []];
        }

        if (
            mb_strlen($name) > 100 ||
            mb_strlen($email) > 150 ||
            mb_strlen($phone) > 50 ||
            mb_strlen($message) > 2000
        ) {
            return [false, 'Unijeti podaci su predugački.', []];
        }

        return [true, null, [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ]];
    }
}