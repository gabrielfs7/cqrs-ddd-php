<?php

use Psr\Container\ContainerInterface;
use Sample\Application\Action\CreateUserAction;
use Sample\Application\Action\ListUserBirthdayAction;

/** @var ContainerInterface $container */
$container = $app->getContainer();

$app->get('/api/users/birthdays', ListUserBirthdayAction::class);
$app->post('[/]', CreateUserAction::class);
