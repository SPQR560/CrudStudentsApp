<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container;

use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\ORMSetup;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeEnum;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeGetter;

readonly class ContainerConfig
{
    public function __construct(private Container $container = new Container())
    {
    }

    public function getContainer(): Container
    {
        $this->setDoctrineSettings();
        $this->setConsoleSettings();


        return $this->container;
    }

    private function setDoctrineSettings(): void
    {
        $envType = (new EnvTypeGetter())->getEnvType();

        $this->container->set('doctrine-config', function () use ($envType) {
            return [
                'devMode' => $envType !== EnvTypeEnum::PROD,
                'connection' => [
                    'url' => getenv('DB_URL'),
                ],
                'pathToXML' => 'Layers/Infrastructure/Config/Doctrine/xmlSchemaMap.xml',
            ];
        });

        $this->container->set(EntityManagerInterface::class, function (ContainerInterface $container) {
            $config = $container['doctrine-config'];
            $xmlSchemeConfiguration = ORMSetup::createXMLMetadataConfiguration(
                $config['pathToXML'],
                $config['connection'],
            );
            return new EntityManager(
                $config['connection'],
                $xmlSchemeConfiguration
            );
        });
    }

    private function setConsoleSettings(): void
    {
        $this->container->set('console-setting', function () {
            return require_once __DIR__ . '/Config/cliCommands.php';
        });
    }
}