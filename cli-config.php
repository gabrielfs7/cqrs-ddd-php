<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

require_once 'bootstrap.php';

$entityManager = $app->getContainer()->get(EntityManager::class);

$databaseConnection = $entityManager->getConnection();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    [
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($databaseConnection),
        'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper(),
        'em' => new EntityManagerHelper($entityManager)
    ]
);

$cli = new Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

ConsoleRunner::addCommands($cli);

$cli->run();
