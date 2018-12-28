<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Query\Bus\QueryBus;
use Sample\Domain\Query\UserBirthdaysQuery;
use Slim\Http\StatusCode;

class ListUserBirthdayAction extends AbstractAction
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(ContainerInterface $container)
    {
        $this->queryBus = $container->get(QueryBus::class);
    }

    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        $userQuery1 = new UserBirthdaysQuery(new DateTimeImmutable('now'));

        return $this->jsonResponse(
            $response,
            StatusCode::HTTP_OK,
            $this->queryBus->ask($userQuery1)->body()
        );
    }
}