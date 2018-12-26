<?php declare(strict_types=1);

use Sample\Command\CommandBus;
use Sample\Command\CreateOrderCommandHandler;
use Sample\Command\CreateUserCommand;
use Sample\Command\CreateUserCommandHandler;
use Sample\Event\EventBus;
use Sample\Event\OrderEventPublisher;
use Sample\Event\UserEventPublisher;
use Sample\Query\FindUserQuery;
use Sample\Query\FindUserQueryHandler;
use Sample\Query\QueryBus;
use Sample\Repository\OrderRepository;
use Sample\Repository\UserRepository;
use Sample\Service\OrderCreator;
use Sample\Service\UserCreator;

require_once 'vendor/autoload.php';

$domainEventBus = new EventBus();

#
# Register Event Publishers
#
$userDomainEventPublisher = new UserEventPublisher($domainEventBus);
$orderDomainEventPublisher = new OrderEventPublisher($domainEventBus);

#
# Register Repositories
#
$userRepository = new UserRepository();
$orderRepository = new OrderRepository();

#
# Register Entity Creators
#
$userCreator = new UserCreator($userRepository, $userDomainEventPublisher);
$orderCreator = new OrderCreator($orderRepository, $orderDomainEventPublisher);

#
# Register Command Handlers
#
$createUserCommandHandler = new CreateUserCommandHandler($userCreator);
$createOrderCommandHandler = new CreateOrderCommandHandler($orderCreator);

#
# Register queries
#
$queryHandler = new FindUserQueryHandler($userRepository);

$commandBus = new CommandBus($createUserCommandHandler, $createOrderCommandHandler);

$queryBus = new QueryBus();
$queryBus->registerHandler($queryHandler);

#
# Register the commands to create users
#
$command1 = new CreateUserCommand(uniqid(), '1', 'John Smith', 'john.smith', 'secret', new DateTimeImmutable('1580-01-01'));
$command2 = new CreateUserCommand(uniqid(), '2', 'Ana Montana', 'ana.montana', 'secret', new DateTimeImmutable('2000-06-08'));
$command3 = new CreateUserCommand(uniqid(), '3', 'Paul Collins', 'paul.collins', 'secret', new DateTimeImmutable('1986-07-11'));
$command4 = new CreateUserCommand(uniqid(), '4', 'Julie West', 'julie.west', 'secret', new DateTimeImmutable('1999-05-06'));

#
# Handle commands
#
$commandBus->dispatch($command1);
$commandBus->dispatch($command2);
$commandBus->dispatch($command3);
$commandBus->dispatch($command4);

#
# Execute query
#
$userQuery1 = new FindUserQuery('1');
$userQuery2 = new FindUserQuery('2');
$userQuery3 = new FindUserQuery('3');
$userQuery4 = new FindUserQuery('4');

#
# Handle query
#
echo PHP_EOL;
var_export($queryBus->ask($userQuery1));
echo PHP_EOL;
var_export($queryBus->ask($userQuery2));
echo PHP_EOL;
var_export($queryBus->ask($userQuery3));
echo PHP_EOL;
var_export($queryBus->ask($userQuery4));
echo PHP_EOL;