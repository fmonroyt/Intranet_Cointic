<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';
    public string $indexPage = '';
    public string $uriProtocol = 'REQUEST_URI';
    public string $defaultLocale = 'es';
    public bool $negotiateLocale = false;
    public string $timezone = 'America/Mexico_City';
}
