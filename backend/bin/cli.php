#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\ContainerConfig;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\DependencyFactory;

$projectPath = dirname(__DIR__);
require_once $projectPath.'/vendor/autoload.php';

if (file_exists($projectPath.'/.env')) {
    (new Dotenv())->usePutenv()->load($projectPath.'/.env');
} else {
    throw new RuntimeException('dot env file is not found');
}

$container = (new ContainerConfig())->getContainer();
$cli = new Application('Console application');

// add entity manager commands
$singleManagerProvider = new SingleManagerProvider($container->get(EntityManagerInterface::class));
ConsoleRunner::addCommands($cli, $singleManagerProvider);

// add doctrine migrations commands
$dependencyFactory = $container->get(DependencyFactory::class);
$cli->addCommands(array(
    new Command\CurrentCommand($dependencyFactory),
    new Command\DiffCommand($dependencyFactory),
    new Command\DumpSchemaCommand($dependencyFactory),
    new Command\ExecuteCommand($dependencyFactory),
    new Command\GenerateCommand($dependencyFactory),
    new Command\LatestCommand($dependencyFactory),
    new Command\ListCommand($dependencyFactory),
    new Command\MigrateCommand($dependencyFactory),
    new Command\RollupCommand($dependencyFactory),
    new Command\StatusCommand($dependencyFactory),
    new Command\SyncMetadataCommand($dependencyFactory),
    new Command\UpToDateCommand($dependencyFactory),
    new Command\VersionCommand($dependencyFactory),
));

$commands = $container->get('console-setting')['commands'];
foreach ($commands as $command) {
    $cli->add($container->get($command));
}

$cli->run();