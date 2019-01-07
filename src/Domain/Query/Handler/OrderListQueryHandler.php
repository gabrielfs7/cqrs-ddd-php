<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Projection\OrderListProjection;
use Sample\Domain\Query\OrderListQuery;
use Sample\Domain\Query\OrderListQueryResponse;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;

class OrderListQueryHandler implements QueryHandlerInterface
{
    /** @var OrderListProjection */
    private $orderListProjection;

    public function __construct(OrderListProjection $orderListProjection)
    {
        $this->orderListProjection = $orderListProjection;
    }

    /**
     * @param QueryInterface|OrderListQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        return new OrderListQueryResponse($this->orderListProjection->list());
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof OrderListQuery;
    }
}
