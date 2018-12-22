<?php declare(strict_types=1);

use Sample\Command\CommandBus;
use Sample\Command\CreateUserCommand;
use Sample\Command\CreateUserCommandHandler;
use Sample\Event\EventBus;
use Sample\Event\UserEventPublisher;
use Sample\Query\FindUserQuery;
use Sample\Query\FindUserQueryHandler;
use Sample\Query\QueryBus;
use Sample\Repository\UserRepository;
use Sample\Service\UserCreator;

require_once 'autoload.php';

$domainEventBus = new EventBus();
$userDomainEventPublisher = new UserEventPublisher($domainEventBus);
$userRepository = new UserRepository();
$userCreator = new UserCreator($userRepository, $userDomainEventPublisher);

$commandHandler = new CreateUserCommandHandler($userCreator);
$queryHandler = new FindUserQueryHandler($userRepository);

$commandBus = new CommandBus();
$commandBus->registerHandler($commandHandler);

$queryBus = new QueryBus();
$queryBus->registerHandler($queryHandler);

#
# Register the commands to create users
#
$command1 = new CreateUserCommand(uniqid(), '1', 'John Smith');
$command2 = new CreateUserCommand(uniqid(), '2', 'Ana Montana');
$command3 = new CreateUserCommand(uniqid(), '3', 'Paul Collins');
$command4 = new CreateUserCommand(uniqid(), '4', 'Julie West');

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