<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;
use Symplify\SmartFileSystem\SmartFileSystem;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->public()
        ->autowire();

    $services->load('Migrify\LatteToTwig\\', __DIR__ . '/../src')
        ->exclude([__DIR__ . '/../src/Contract', __DIR__ . '/../src/Exception', __DIR__ . '/../src/HttpKernel/LatteToTwigKernel.php']);

    $services->set(SymfonyStyleFactory::class);

    $services->set(SymfonyStyle::class)
        ->factory([ref(SymfonyStyleFactory::class), 'create']);

    $services->set(FinderSanitizer::class);

    $services->set(SmartFileSystem::class);
};
