<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
use Sample\Domain\Query\Bus\QueryBus;
use Sample\Domain\Query\UserBirthdaysQuery;

class ListUserBirthdayAction
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(): array
    {
        $userQuery1 = new UserBirthdaysQuery(new DateTimeImmutable('now'));

        return $this->queryBus->ask($userQuery1)->body();
    }
}