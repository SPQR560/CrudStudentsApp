<?php

declare(strict_types=1);

use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User\EmailType;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeEnum;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User\UserIdType;

return [
    'devMode' => $envType !== EnvTypeEnum::PROD,
    'connection' => [
        'url' => getenv('DB_URL'),
        'driver' => 'pdo_pgsql',
    ],
    'pathsToXML' => [
        'Layers/Infrastructure/Config/Doctrine/xmlSchemaMap.xml',
    ],
    'cacheDir' => 'var/cache/doctrine',
    'types' => [
        UserIdType::NAME => UserIdType::class,
        EmailType::NAME => EmailType::class,
    ],
];