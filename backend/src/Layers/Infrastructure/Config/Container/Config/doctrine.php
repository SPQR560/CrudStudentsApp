<?php

declare(strict_types=1);

use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User\EmailType;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType\EnvTypeEnum;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User\UserIdType;

return [
    'devMode' => $envType !== EnvTypeEnum::PROD,
    'connection' => [
        'driver' => 'pdo_pgsql',
        'host' => getenv('POSTGRES_HOST'),
        'user' => getenv('POSTGRES_USER'),
        'password' => getenv('POSTGRES_PASSWORD'),
        'dbname' => getenv('POSTGRES_DB'),
        'charset' => 'utf-8',
    ],
    'pathsToXML' => [
        'src/Layers/Infrastructure/Config/Doctrine',
    ],
    'cacheDir' => 'var/cache/doctrine',
    'types' => [
        UserIdType::NAME => UserIdType::class,
        EmailType::NAME => EmailType::class,
    ],
];