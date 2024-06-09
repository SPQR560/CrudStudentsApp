<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container;

use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\ORMSetup;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeEnum;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeGetter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

readonly class ContainerConfig
{
    public function __construct(private Container $container = new Container())
    {
    }

    public function getContainer(): Container
    {
        $this->setDoctrineSettings();
        $this->setConsoleSettings();
        $this->setDoctrineMigrationSettings();

        return $this->container;
    }

    private function setDoctrineSettings(): void
    {
        $envType = (new EnvTypeGetter())->getEnvType();

        $this->container->set('doctrine-config', function () use ($envType) {
            return ;
        });

        $this->container->set(EntityManagerInterface::class, function (ContainerInterface $container) {
            $config = $container->get('doctrine-config');
            $xmlSchemeConfiguration = ORMSetup::createXMLMetadataConfiguration(
                $config['pathsToXML'],
                $config['devMode'],
                cache: new FilesystemAdapter(directory: $config['cacheDir'])
            );
            return new EntityManager(
                DriverManager::getConnection($config['connection']),
                $xmlSchemeConfiguration
            );
        });
    }

    private function setConsoleSettings(): void
    {
        $this->container->set('console-setting', function () {
            return require_once __DIR__ . '/Config/console.php';
        });
    }

    private function setDoctrineMigrationSettings(): void
    {
        $settings = require_once __DIR__ . '/Config/migrations.php';
        $this->container->set(DependencyFactory::class, $settings[DependencyFactory::class]);
    }
}