<?php

declare(strict_types=1);

use CodeIgniter\Config\Paths;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$paths = new Paths();

require $paths->systemDirectory . '/bootstrap.php';

$app = Config\Services::codeigniter();
$app->initialize();
$app->run();
