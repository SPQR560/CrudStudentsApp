<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

if (file_exists('.env')) {
    (new Dotenv())->usePutenv()->load('.env');
} else {
    throw new RuntimeException('dot env file is not found');
}
