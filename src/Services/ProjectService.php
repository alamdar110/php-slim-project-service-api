<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ProjectRepository;
use InvalidArgumentException;

final class ProjectService
{
    public function __construct(private readonly ProjectRepository $projects)
    {
    }

    public function list(): array
    {
        return $this->projects->all();
    }

    public function create(array $input): array
    {
        foreach (['name', 'customer_name'] as $field) {
            if (empty($input[$field])) {
                throw new InvalidArgumentException("Missing required field: {$field}");
            }
        }

        return $this->projects->create([
            'name' => trim((string)$input['name']),
            'customer_name' => trim((string)$input['customer_name']),
            'status' => $input['status'] ?? 'draft',
        ]);
    }

    public function find(int $id): array
    {
        return $this->projects->find($id);
    }
}
