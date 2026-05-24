<?php

declare(strict_types=1);

namespace App\Repositories;

class TenderEnquiryRepository extends BaseRepository
{
    public function create(int $projectId, array $input): array
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO tender_enquiries (project_id, package_name, recipient_email, status) VALUES (:project_id, :package_name, :recipient_email, :status)'
        );
        $stmt->execute([
            'project_id' => $projectId,
            'package_name' => $input['package_name'],
            'recipient_email' => $input['recipient_email'],
            'status' => 'draft',
        ]);

        return ['id' => (int)$this->pdo->lastInsertId(), 'status' => 'draft'];
    }

    public function updateStatus(int $id, string $status): array
    {
        $stmt = $this->pdo->prepare('UPDATE tender_enquiries SET status = :status WHERE id = :id');
        $stmt->execute(['id' => $id, 'status' => $status]);

        return ['id' => $id, 'status' => $status];
    }
}
