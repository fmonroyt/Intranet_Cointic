<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail = 'no-reply@cointic.local';
    public string $fromName = 'Intranet Cointic';
    public string $protocol = 'smtp';
    public string $SMTPHost = 'smtp.example.com';
    public string $SMTPUser = 'usuario@example.com';
    public string $SMTPPass = 'password';
    public int $SMTPPort = 587;
    public string $SMTPCrypto = 'tls';
    public string $mailType = 'html';
    public string $charset = 'utf-8';
    public string $wordWrap = 'TRUE';
}
