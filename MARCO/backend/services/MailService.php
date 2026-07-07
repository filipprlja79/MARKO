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

        $logoPath = self::resolveLogoPath($config);
        $logoSrc = $logoPath !== null
            ? 'cid:marco-logo-admin'
            : (!empty($config['mail_logo_url']) ? $config['mail_logo_url'] : rtrim($config['base_url'], '/') . '/logo-mail.png');

        if ($logoPath !== null) {
            $mail->addEmbeddedImage($logoPath, 'marco-logo-admin', 'logo-mail.png');
        }

        $mail->setFrom($config['mail_from'], $config['mail_from_name']);
        $mail->addAddress($config['mail_to']);
        $mail->addReplyTo($data['email'], $data['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Nova poruka sa MARCO sajta';

        $mail->Body = "
            <div style='margin:0;padding:0;background:#f6f2ec;font-family:Arial,Helvetica,sans-serif;color:#2f2418;'>
                <div style='max-width:640px;margin:0 auto;padding:24px 16px;'>
                    <div style='background:#111111;border-radius:18px 18px 0 0;padding:28px 24px;text-align:center;'>
                        <img src='{$logoSrc}' alt='MARCO Delicatess Selection logo' style='display:block;max-width:220px;height:auto;margin:0 auto 14px;' />
                        <h1 style='margin:0;color:#d6a15d;font-size:22px;font-weight:700;letter-spacing:0.3px;'>
                            Nova poruka sa web sajta
                        </h1>
                    </div>

                    <div style='background:#ffffff;padding:32px 28px;border-radius:0 0 18px 18px;border:1px solid #eadfce;border-top:none;'>
                        <p style='font-size:16px;margin:0 0 14px;'>
                            <strong>Ime i prezime:</strong><br>{$safeName}
                        </p>
                        <p style='font-size:15px;margin:0 0 14px;'>
                            <strong>Email:</strong><br>{$safeEmail}
                        </p>
                        <p style='font-size:15px;margin:0 0 18px;'>
                            <strong>Telefon:</strong><br>{$safePhone}
                        </p>

                        <div style='background:#f9f4ed;border-left:4px solid #8f642c;padding:14px 16px;margin:0 0 18px;border-radius:10px;'>
                            <p style='margin:0;font-size:15px;line-height:1.7;color:#4a3a28;'><strong>Poruka:</strong></p>
                            <p style='margin:6px 0 0;font-size:15px;line-height:1.7;color:#4a3a28;'>{$safeMessage}</p>
                        </div>
                    </div>

                    <p style='text-align:center;color:#8a8177;font-size:12px;margin:16px 0 0;'>
                        Poruka je poslata preko kontakt forme na MARCO sajtu.
                    </p>
                </div>
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

try {
    self::sendAutoReply($config, $data);
} catch (Exception $e) {
    error_log('Auto reply error: ' . $e->getMessage());
}
    }

    private static function sendAutoReply(array $config, array $data): void
    {
        $safeName = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $logoUrl = !empty($config['mail_logo_url'])
            ? $config['mail_logo_url']
            : rtrim($config['base_url'], '/') . '/logo-mail.png';

        $mail = self::baseMailer($config);

        $logoPath = self::resolveLogoPath($config);
        $logoSrc = $logoPath !== null ? 'cid:marco-logo' : $logoUrl;

        if ($logoPath !== null) {
            $mail->addEmbeddedImage($logoPath, 'marco-logo', 'logo-mail.png');
        }

        $mail->setFrom($config['mail_from'], $config['mail_from_name']);
        $mail->addAddress($data['email'], $data['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Potvrda prijema poruke | MARCO';

        $mail->Body = "
            <div style='margin:0;padding:0;background:#f6f2ec;font-family:Arial,Helvetica,sans-serif;color:#2f2418;'>
                <div style='max-width:640px;margin:0 auto;padding:24px 16px;'>
                    <div style='background:#111111;border-radius:18px 18px 0 0;padding:28px 24px;text-align:center;'>
                        <img src='{$logoSrc}' alt='MARCO Delicatess Selection logo' style='display:block;max-width:220px;height:auto;margin:0 auto 14px;' />
                        <h1 style='margin:0;color:#d6a15d;font-size:22px;font-weight:700;letter-spacing:0.3px;'>
                            Poruka je uspješno primljena
                        </h1>
                    </div>

                    <div style='background:#ffffff;padding:32px 28px;border-radius:0 0 18px 18px;border:1px solid #eadfce;border-top:none;'>
                        <p style='font-size:16px;margin:0 0 14px;'>
                            Poštovani/a <strong>{$safeName}</strong>,
                        </p>

                        <p style='font-size:15px;line-height:1.7;margin:0 0 16px;'>
                            Hvala Vam što ste kontaktirali <strong>MARCO Delicatess Selection</strong>.
                            Vaša poruka je primljena i naš tim će Vas kontaktirati u najkraćem mogućem roku.
                        </p>

                        <div style='background:#f9f4ed;border-left:4px solid #8f642c;padding:14px 16px;margin:20px 0 24px;border-radius:10px;'>
                            <p style='margin:0;font-size:14px;line-height:1.6;color:#4a3a28;'>
                                Ovo je automatska potvrda prijema poruke. Nije potrebno odgovarati na ovaj email.
                            </p>
                        </div>

                        <p style='font-size:15px;line-height:1.7;margin:0 0 6px;'>
                            Srdačan pozdrav,
                        </p>

                        <p style='font-size:15px;margin:0;'>
                            <strong>MARCO Delicatess Selection</strong>
                        </p>
                    </div>

                    <p style='text-align:center;color:#8a8177;font-size:12px;margin:16px 0 0;'>
                        MARCO Delicatess Selection · Premium suhomesnati proizvodi
                    </p>
                </div>
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

    private static function resolveLogoPath(array $config): ?string
    {
        $candidateLogoPaths = [
            !empty($config['mail_logo_path']) ? $config['mail_logo_path'] : null,
            dirname(__DIR__, 2) . '/public/logo-mail.png',
            dirname(__DIR__, 2) . '/public/LOGO-backgroudoff.png',
            dirname(__DIR__, 2) . '/src/assets/images/LOGO-backgroudoff.png',
            dirname(__DIR__, 2) . '/src/assets/images/LOGO-backgroudoff-Bi2H5rMr.png',
        ];

        foreach ($candidateLogoPaths as $candidatePath) {
            if (!empty($candidatePath) && file_exists($candidatePath)) {
                return $candidatePath;
            }
        }

        return null;
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