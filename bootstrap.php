<?php

use DI\Bridge\Slim\App;
use DI\ContainerBuilder;

require 'vendor/autoload.php';

$app = new class() extends App {
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/config/settings.php');
        $builder->addDefinitions(__DIR__ . '/config/dependencies.php');
    }
};

require 'config/routes.php';
