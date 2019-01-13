<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Sample\Domain\Command\Bus\CommandBusInterface;
use Sample\Domain\Command\CommandInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CommandConsumer
{
    /** @var AMQPStreamConnection */
    private $streamConnection;

    /** @var CommandHandlerInterface[] */
    private $commandHandlers;

    public function __construct(
        AMQPStreamConnection $streamConnection,
        CreateUserCommandHandler $createUserCommandHandler,
        UpdateUserCommandHandler $updateUserCommandHandler,
        CreateOrderCommandHandler $createOrderCommandHandler
    ) {
        $this->streamConnection = $streamConnection;
        $this->commandHandlers = [
            $createUserCommandHandler,
            $updateUserCommandHandler,
            $createOrderCommandHandler
        ];
    }

    public function handle(OutputInterface $output): void
    {
        $channel = $this->streamConnection->channel();

        $channel->queue_declare(
            CommandBusInterface::QUEUE_NAME,
            false,
            false,
            false,
            false
        );

        $callback = function (AMQPMessage $msg) use ($output) {
            try {
                /** @var CommandInterface $command */
                $command = unserialize($msg->body);

                foreach ($this->commandHandlers as $commandHandler) {
                    if ($commandHandler->canHandle($command)) {
                        $commandHandler($command);

                        $output->writeln(sprintf(' [√] Received command %s',  $command->id()));

                        return;
                    }
                }
            } catch (Exception $exception) {
                $output->writeln(sprintf(' [!] Error: %s',  $exception->getMessage()));
            }
        };

        $channel->basic_consume(
            CommandBusInterface::QUEUE_NAME,
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
