<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\EnvType;

class EnvTypeGetter
{
    public function __construct(private string $envType = '')
    {
        if ($envType === '') {
            $this->envType = getenv('ENV_TYPE');
        }
    }

    public function getEnvType(): EnvTypeEnum
    {
        return match ($this->envType) {
            'test' => EnvTypeEnum::TEST,
            'dev' => EnvTypeEnum::DEV,
            default => EnvTypeEnum::PROD,
        };
    }
}