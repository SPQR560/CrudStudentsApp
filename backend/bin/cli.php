#!/usr/bin/env php
<?php

declare(strict_types=1);

use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\ContainerConfig;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$projectPath = dirname(__DIR__);
require_once $projectPath.'/vendor/autoload.php';

if (file_exists($projectPath.'/.env')) {
    (new Dotenv())->usePutenv()->load($projectPath.'/.env');
} else {
    throw new RuntimeException('dot env file is not found');
}

$container = (new ContainerConfig())->getContainer();
$cli = new Application('Console application');


$commands = $container->get('console-setting')['commands'];
foreach ($commands as $command) {
    $cli->add($container->get($command));
}

$cli->run();