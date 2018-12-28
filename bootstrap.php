<?php

use DI\ContainerBuilder;

require 'vendor/autoload.php';

$app = new class() extends \DI\Bridge\Slim\App {
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/config/settings.php');
        $builder->addDefinitions(__DIR__ . '/config/dependencies.php');
    }
};

require 'config/routes.php';
