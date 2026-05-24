<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TenderEnquiryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class TenderEnquiryController
{
    public function __construct(private readonly TenderEnquiryService $enquiries)
    {
    }

    public function store(Request $request, Response $response, array $args): Response
    {
        $payload = $this->enquiries->create((int)$args['id'], (array)$request->getParsedBody());
        $response->getBody()->write(json_encode($payload, JSON_THROW_ON_ERROR));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function updateStatus(Request $request, Response $response, array $args): Response
    {
        $payload = $this->enquiries->updateStatus((int)$args['id'], (array)$request->getParsedBody());
        $response->getBody()->write(json_encode($payload, JSON_THROW_ON_ERROR));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
