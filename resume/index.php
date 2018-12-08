<?php declare(strict_types=1);

spl_autoload_register(
    function ($classname) {
        $file = $classname . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
);

$userDomainEventPublisher = new UserDomainEventPublisher();
$userRepository = new UserRepository();
$userCreator = new UserCreator($userRepository, $userDomainEventPublisher);
$commandHandler = new CreateUserCommandHandler($userCreator);

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
//@TODO Implement query...