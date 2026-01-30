<?php

declare(strict_types=1);

use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Database\Models\Tenant;

return [
    'tenant_model' => \App\Models\Central\Tenant::class,
    
    'id_generator' => Stancl\Tenancy\UUIDGenerator::class,

    'central_domains' => [
        'localhost',
        '127.0.0.1',
    ],

    'database' => [
        'central_connection' => env('DB_CONNECTION', 'mysql'),
        
        'template_tenant_connection' => null,

        'prefix' => env('TENANCY_DATABASE_PREFIX', 'tenant_'),
        
        'suffix' => env('TENANCY_DATABASE_SUFFIX', ''),

        'managers' => [
            'sqlite' => Stancl\Tenancy\Database\DatabaseManager::class,
            'mysql' => Stancl\Tenancy\Database\DatabaseManager::class,
            'pgsql' => Stancl\Tenancy\Database\DatabaseManager::class,
        ],
    ],

    'redis' => [
        'prefix_base' => 'tenant',
        'prefixed_connections' => [],
    ],

    'cache' => [
        'tag_base' => 'tenant',
    ],

    'filesystem' => [
        'suffix_base' => 'tenant',
        'disks' => [
            'local',
            'public',
        ],
    ],

    'features' => [
        // Stancl\Tenancy\Features\UserImpersonation::class,
        // Stancl\Tenancy\Features\TelescopeTags::class,
        // Stancl\Tenancy\Features\TenantConfig::class,
        Stancl\Tenancy\Features\CrossDomainRedirect::class,
        Stancl\Tenancy\Features\UniversalRoutes::class,
        Stancl\Tenancy\Features\TenantRedirect::class,
    ],

    'home_url' => '/',

    'bootstrappers' => [
        Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\CacheTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\FilesystemTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\QueueTenancyBootstrapper::class,
        // Stancl\Tenancy\Bootstrappers\RedisTenancyBootstrapper::class,
    ],

    'migration_parameters' => [
        '--force' => true,
        '--path' => [database_path('migrations/tenant')],
        '--realpath' => true,
    ],

    'seeder_parameters' => [
        '--class' => 'TenantSeeder',
    ],
];