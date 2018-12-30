<?php

namespace Sample\Application\Action;

use HttpRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction
{
    protected function jsonResponse(
        ResponseInterface $response,
        int $statusCode,
        array $content = null
    ): ResponseInterface {
        if ($content !== null) {
            $response->getBody()->write(json_encode($content));
        }

        $response = $response->withStatus($statusCode);

        return $response->withAddedHeader('Content-type', 'application/json');
    }

    protected function parseJsonRequest(RequestInterface $request): array
    {
        $receivedPayload = json_decode($request->getBody()->getContents(), true);

        if ($code = json_last_error()) {
            throw new HttpRequestException(
                sprintf('Invalid Json provided: [%s] %s', $code, json_last_error_msg())
            );
        }

        return array_merge($this->getPayloadDefault(), $receivedPayload);
    }

    protected function getPayloadDefault(): array
    {
        return [];
    }
}
