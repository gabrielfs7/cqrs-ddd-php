<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
use Psr\Container\ContainerInterface;
use Sample\Domain\Query\Bus\QueryBus;
use Sample\Domain\Query\UserBirthdaysQuery;

class ListUserBirthdayAction
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(ContainerInterface $container)
    {
        $this->queryBus = $container->get(QueryBus::class);
    }

    public function __invoke(): array
    {
        $userQuery1 = new UserBirthdaysQuery(new DateTimeImmutable('now'));

        return $this->queryBus->ask($userQuery1)->body();
    }
}