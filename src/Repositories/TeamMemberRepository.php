<?php

declare(strict_types=1);

namespace App\Repositories;

class TeamMemberRepository extends BaseRepository
{
    public function create(int $projectId, array $input): array
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO project_team_members (project_id, name, email, role) VALUES (:project_id, :name, :email, :role)'
        );
        $stmt->execute([
            'project_id' => $projectId,
            'name' => $input['name'] ?? null,
            'email' => $input['email'],
            'role' => $input['role'],
        ]);

        return [
            'id' => (int)$this->pdo->lastInsertId(),
            'project_id' => $projectId,
            'email' => $input['email'],
            'role' => $input['role'],
        ];
    }
}
