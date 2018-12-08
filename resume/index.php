<?php declare(strict_types=1);

use Sample\Command\CreateUserCommand;
use Sample\Command\CreateUserCommandHandler;
use Sample\Event\UserDomainEventPublisher;
use Sample\Query\FindUserQuery;
use Sample\Query\FindUserQueryHandler;
use Sample\Repository\UserRepository;
use Sample\Service\UserCreator;

spl_autoload_register(
    function ($className) {
        $file = str_replace(
            'Sample' . DIRECTORY_SEPARATOR,
            '',
            str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                $className
            )
        ) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
);

$userDomainEventPublisher = new UserDomainEventPublisher();
$userRepository = new UserRepository();
$userCreator = new UserCreator($userRepository, $userDomainEventPublisher);
$commandHandler = new CreateUserCommandHandler($userCreator);
$queryHandler = new FindUserQueryHandler($userRepository);

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
$commandHandler($command1);
$commandHandler($command2);
$commandHandler($command3);
$commandHandler($command4);

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
var_export($queryHandler($userQuery1));
echo PHP_EOL;
var_export($queryHandler($userQuery2));
echo PHP_EOL;
var_export($queryHandler($userQuery3));
echo PHP_EOL;
var_export($queryHandler($userQuery4));
echo PHP_EOL;