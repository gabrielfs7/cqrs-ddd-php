<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
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
        CreateOrderCommandHandler $createOrderCommandHandler
    ) {
        $this->streamConnection = $streamConnection;
        $this->commandHandlers = [
            $createUserCommandHandler,
            $createOrderCommandHandler
        ];
    }

    public function handle(OutputInterface $output): void
    {
        $channel = $this->streamConnection->channel();

        $channel->queue_declare(
            'hello',
            false,
            false,
            false,
            false
        );

        $callback = function (AMQPMessage $msg) use ($output) {
            /** @var CommandInterface $command */
            $command = unserialize($msg->body);

            foreach ($this->commandHandlers as $commandHandler) {
                if ($commandHandler->canHandle($command)) {
                    $commandHandler($command);

                    $output->writeln(sprintf(' [√] Received command %s',  $command->id()));

                    return;
                }
            }
        };

        $channel->basic_consume(
            'hello',
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
