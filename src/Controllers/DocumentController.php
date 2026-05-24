<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\DocumentService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class DocumentController
{
    public function __construct(private readonly DocumentService $documents)
    {
    }

    public function store(Request $request, Response $response, array $args): Response
    {
        $payload = $this->documents->attach((int)$args['id'], (array)$request->getParsedBody());
        $response->getBody()->write(json_encode($payload, JSON_THROW_ON_ERROR));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
