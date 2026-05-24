<?php

declare(strict_types=1);

namespace App\Repositories;

class DocumentRepository extends BaseRepository
{
    public function create(int $tenderEnquiryId, array $input): array
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO documents (tender_enquiry_id, filename, storage_key, mime_type) VALUES (:tender_enquiry_id, :filename, :storage_key, :mime_type)'
        );
        $stmt->execute([
            'tender_enquiry_id' => $tenderEnquiryId,
            'filename' => $input['filename'],
            'storage_key' => $input['storage_key'],
            'mime_type' => $input['mime_type'],
        ]);

        return ['id' => (int)$this->pdo->lastInsertId(), 'filename' => $input['filename']];
    }
}
