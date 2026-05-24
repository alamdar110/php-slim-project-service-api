<?php

declare(strict_types=1);

namespace App\Repositories;

class ProjectRepository extends BaseRepository
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM projects ORDER BY id DESC')->fetchAll();
    }

    public function create(array $input): array
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO projects (name, customer_name, status) VALUES (:name, :customer_name, :status)'
        );
        $stmt->execute($input);

        return $this->find((int)$this->pdo->lastInsertId());
    }

    public function find(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM projects WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: [];
    }
}
