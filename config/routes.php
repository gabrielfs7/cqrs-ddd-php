<?php

use Psr\Container\ContainerInterface;
use Sample\Application\Action\CreateUserAction;
use Sample\Application\Action\CreateOrderAction;
use Sample\Application\Action\UserBirthdayListAction;
use Sample\Application\Action\OrderListAction;

/** @var ContainerInterface $container */
$container = $app->getContainer();

$app->get('/api/users/birthdays[/]', UserBirthdayListAction::class);
$app->post('/api/users[/]', CreateUserAction::class);
$app->post('/api/orders[/]', CreateOrderAction::class);
$app->post('/api/orders[/]', OrderListAction::class);
