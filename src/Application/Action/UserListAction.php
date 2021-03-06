<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Query\Bus\QueryBus;
use Sample\Domain\Query\UserListQuery;
use Slim\Http\StatusCode;

class UserListAction extends AbstractAction
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        $query = new UserListQuery(new DateTimeImmutable('now'));

        return $this->jsonResponse(
            $response,
            StatusCode::HTTP_OK,
            $this->queryBus->ask($query)->body()
        );
    }
}
