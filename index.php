<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\CreateUserCommand;
use Sample\Domain\Query\Bus\QueryBus;
use Sample\Domain\Query\FindUserQuery;

require_once 'vendor/autoload.php';

$container = ContainerBuilder::buildDevContainer();

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
$commandBus = $container->get(CommandBus::class);
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

$queryBus = $container->get(QueryBus::class);

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