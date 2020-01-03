<?php

use Selective\Config\Configuration;

$settings = new Configuration(require __DIR__ . '/config/settings.php');
return [
    'paths' => [
      'migrations' => 'database/migrations',
      'seeds' => 'database/seeds'
    ],
    'migration_base_class' => 'Migrations\Migration',
    'environments' => [
      'default_database' => 'dev',
      'dev' => [
        'adapter' => $settings->getString('db.driver'),
        'host' => $settings->getString('db.host'),
        'name' => $settings->getString('db.database'),
        'user' => $settings->getString('db.username'),
        'pass' => $settings->getString('db.password'),
        'port' => '3306'
      ]
    ]
  ];