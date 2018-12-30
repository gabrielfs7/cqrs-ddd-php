<?php declare(strict_types=1);

namespace Sample\Domain\Command\Bus;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Sample\Domain\Command\CommandInterface;

final class CommandBus implements CommandBusInterface
{
    /** @var AMQPStreamConnection */
    private $streamConnection;

    public function __construct(AMQPStreamConnection $streamConnection)
    {
        $this->streamConnection = $streamConnection;
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->streamConnection->reconnect();

        $channel = $this->streamConnection->channel();
        $channel->queue_declare(
            'hello',
            false,
            false,
            false,
            false
        );

        $msg = new AMQPMessage(serialize($command));

        $channel->basic_publish($msg, '', 'hello');
        $channel->close();

        $this->streamConnection->close();
    }
}
