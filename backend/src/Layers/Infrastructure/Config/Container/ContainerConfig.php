<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container;

use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\ORMSetup;
use Slim\App;

class ContainerConfig
{
    public static function init(Container &$container): void
    {
        self::setDoctrineSettings($container);

        $container->set(EntityManagerInterface::class, function (ContainerInterface $container) {
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

    private static function setDoctrineSettings(Container &$container)
    {
        $container->set('doctrine-config', function () {
            return [
                'devMode' => true,
                'connection' => [
                    'url' => getenv('DB_URL'),
                ],
                'pathToXML' => 'Layers/Infrastructure/Config/Doctrine/xmlSchemaMap.xml',
            ];
        });
    }
}