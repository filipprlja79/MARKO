<?php

use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    public static function sendContactMail(array $config, array $data): void
    {
        $safeName = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $safeEmail = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $safePhone = $data['phone'] !== ''
            ? htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8')
            : 'Nije ostavljen broj telefona';
        $safeMessage = nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8'));

        $mail = self::baseMailer($config);

        $mail->setFrom($config['mail_from'], $config['mail_from_name']);
        $mail->addAddress($config['mail_to']);
        $mail->addReplyTo($data['email'], $data['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Nova poruka sa MARCO sajta';

        $mail->Body = "
            <div style='font-family:Arial,sans-serif;color:#222;line-height:1.6;'>
                <h2 style='color:#8f642c;'>MARCO Delicatess Selection</h2>
                <h3>Nova poruka sa web sajta</h3>

                <p><strong>Ime i prezime:</strong><br>{$safeName}</p>
                <p><strong>Email:</strong><br>{$safeEmail}</p>
                <p><strong>Telefon:</strong><br>{$safePhone}</p>

                <hr>

                <p><strong>Poruka:</strong></p>
                <p>{$safeMessage}</p>

                <hr>

                <p style='font-size:12px;color:#777;'>
                    Poruka je poslata preko kontakt forme na MARCO sajtu.
                </p>
            </div>
        ";

        $mail->AltBody = "
Nova poruka sa MARCO sajta

Ime i prezime: {$data['name']}
Email: {$data['email']}
Telefon: " . ($data['phone'] !== '' ? $data['phone'] : 'Nije ostavljen broj telefona') . "

Poruka:
{$data['message']}
        ";

        $mail->send();

        self::sendAutoReply($config, $data);
    }

    private static function sendAutoReply(array $config, array $data): void
    {
        $mail = self::baseMailer($config);

        $mail->setFrom($config['mail_from'], $config['mail_from_name']);
        $mail->addAddress($data['email'], $data['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Vaša poruka je primljena - MARCO';

        $safeName = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');

        $mail->Body = "
            <div style='font-family:Arial,sans-serif;color:#222;line-height:1.6;'>
                <h2 style='color:#8f642c;'>MARCO Delicatess Selection</h2>

                <p>Poštovani/a {$safeName},</p>

                <p>Hvala Vam što ste kontaktirali MARCO Delicatess Selection.</p>

                <p>Vaša poruka je uspješno primljena. Naš tim će Vas kontaktirati u najkraćem mogućem roku.</p>

                <p>Srdačan pozdrav,<br>MARCO Delicatess Selection</p>
            </div>
        ";

        $mail->AltBody = "
Poštovani/a {$data['name']},

Hvala Vam što ste kontaktirali MARCO Delicatess Selection.

Vaša poruka je uspješno primljena. Naš tim će Vas kontaktirati u najkraćem mogućem roku.

Srdačan pozdrav,
MARCO Delicatess Selection
        ";

        $mail->send();
    }

    private static function baseMailer(array $config): PHPMailer
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];

        $mail->SMTPSecure = $config['smtp_secure'] === 'ssl'
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';

        return $mail;
    }
}