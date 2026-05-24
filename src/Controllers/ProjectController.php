<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ProjectService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ProjectController
{
    public function __construct(private readonly ProjectService $projects)
    {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->json($response, $this->projects->list());
    }

    public function store(Request $request, Response $response): Response
    {
        $project = $this->projects->create((array)$request->getParsedBody());
        return $this->json($response, $project, 201);
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        return $this->json($response, $this->projects->find((int)$args['id']));
    }

    private function json(Response $response, mixed $payload, int $status = 200): Response
    {
        $response->getBody()->write(json_encode($payload, JSON_THROW_ON_ERROR));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}
