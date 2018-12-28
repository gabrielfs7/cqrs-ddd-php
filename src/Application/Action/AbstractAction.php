<?php

namespace Sample\Application\Action;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction
{
    protected function jsonResponse(
        ResponseInterface $response,
        int $statusCode,
        array $content = []
    ): ResponseInterface {
        if ($content !== null) {
            $response->getBody()->write(json_encode($content));
        }

        $response = $response->withStatus($statusCode);

        return $response->withAddedHeader('Content-type', 'application/json');
    }
}
