<?php

use Psr\Container\ContainerInterface;
use Sample\Application\Action\CreateUserAction;
use Sample\Application\Action\UpdateUserAction;
use Sample\Application\Action\CreateOrderAction;
use Sample\Application\Action\UpdateOrderAction;
use Sample\Application\Action\UserBirthdayListAction;
use Sample\Application\Action\UserListAction;
use Sample\Application\Action\OrderListAction;

/** @var ContainerInterface $container */
$container = $app->getContainer();

$app->get('/api/users/birthdays[/]', UserBirthdayListAction::class);
$app->post('/api/users[/]', CreateUserAction::class);
$app->patch('/api/users/{userId}[/]', UpdateUserAction::class);
$app->get('/api/users[/]', UserListAction::class);

$app->get('/api/orders[/]', OrderListAction::class);
$app->post('/api/orders[/]', CreateOrderAction::class);
$app->patch('/api/orders/{orderId}', UpdateOrderAction::class);
